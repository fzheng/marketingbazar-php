<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @author Feng Zheng
 *        
 *         Linkedin API resource map: https://developer.linkedin.com/documents/linkedin-api-resource-map
 *        
 */
class Main extends CI_Controller {

	public function Main() {
		parent::__construct();
		parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
        $this->load->model('email_model');
	}

	function index() {
        if(defined('ENVIRONMENT') && ENVIRONMENT === "prod") {
            $this->load->library('session');
            $current_ip = ip2long($this->session->userdata('ip_address'));
            $result = $this->db->query('select * from ipaddresses where ip = ?', $current_ip);
            if (!$result->row() || $result->row()->flag <=0) {
                header('HTTP/1.0 404 Not Found');
                echo '<h1>404, Page NOT Found</h1><h2>Sorry, the Website is still Under Construction</h2>';
                exit();
            }
        }
		$sessionData = $this->session->all_userdata();
		$user_id = array_key_exists('user_id', $sessionData) ? $sessionData['user_id'] : null;
		if (is_null($user_id)) {
			$this->load->view('auth');
		}
        else if ($user_id == 0) {
            $this->load->view('signup', $sessionData);
        }
        else {
            $result = $this->db->query('select * from users where id = ?', $user_id);
            if (empty($result->row()->email_salt)) {
                $this->load->library('scorecard');
                $sessionData['score'] = $this->scorecard->score($user_id);
                $sessionData['rank'] = $this->scorecard->rank($user_id);
                $this->load->view('home', $sessionData);
            } else {
                $data = array (
                    'user_id' => $result->row()->id
                );
                $this->load->view('emails/email_not_activate', $data);
            }
        }
	}

	public function oauth($providername) {
		$this->config->load('oauth', TRUE);
        $oauthConfig = $this->config->item('oauth');
		$key = $oauthConfig[$providername]['key'];
		$secret = $oauthConfig[$providername]['secret'];
		$this->load->helper('url');
		$this->load->spark('oauth/0.3.1');
		// Create an consumer from the config
		$consumer = $this->oauth->consumer(array('key' => $key, 'secret' => $secret));
		// Load the provider
		$provider = $this->oauth->provider($providername);
		// Create the URL to return the user to
		$callback = site_url('main/oauth/' . $provider->name);
		if (!$this->input->get_post('oauth_token')) {
			// Add the callback URL to the consumer
			$consumer->callback($callback);
			// Get a request token for the consumer
			$token = $provider->request_token($consumer);
			// Store the token
			$this->session->set_userdata('oauth_token', base64_encode(serialize($token)));
			// Get the URL to the twitter login page
			$url = $provider->authorize($token, array('oauth_callback' => $callback));
			// Send the user off to login
			redirect($url);
		} else {
			if ($this->session->userdata('oauth_token')) {
				// Get the token from storage
				$token = unserialize(base64_decode($this->session->userdata('oauth_token')));
			}
			if (!empty($token) and $token->access_token !== $this->input->get_post('oauth_token')) {
				// Delete the token, it is not valid
				$this->session->unset_userdata('oauth_token');
				// Send the user back to the beginning
				exit('invalid token after coming back to site');
			}
			// Get the verifier
			$verifier = $this->input->get_post('oauth_verifier');
			// Store the verifier in the token
			$token->verifier($verifier);
			// Exchange the request token for an access token
			$token = $provider->access_token($consumer, $token);
			// We got the token, let's get some user data
			$user = $provider->get_user_info($consumer, $token);
			$this->saveData($providername, $token, $user);
		}
	}

	public function oauth2($providername) {
		$this->config->load('oauth', TRUE);
        $oauthConfig = $this->config->item('oauth');
		$key = $oauthConfig[$providername]['key'];
		$secret = $oauthConfig[$providername]['secret'];
		$this->load->helper('url_helper');
		$this->load->spark('oauth2/0.4.0');
		$provider = $this->oauth2->provider($providername, array('id' => $key, 'secret' => $secret));

		if (!$this->input->get('code')) {
			// By sending no options it'll come back here
			redirect($provider->authorize());
		} else {
			try {
				$token = $provider->access($_GET['code']);
				$user = $provider->get_user_info($token);
				$this->saveData($providername, $token, $user);
			} catch (OAuth2_Exception $e) {
				show_error('That did not work: ' . $e);
			}
		}
	}

    public function login() {
        if (isset($_POST["email"])) {
            $result = $this->db->query("select * from users where email = ? and pwd_salt = ?", array($_POST["email"], $_POST["password"]));
        } else {
            $result = $this->db->query("select * from users where username = ? and pwd_salt = ?", array($_POST["username"], $_POST["password"]));
        }
        if ($result->row()) {
            $this->load->library('session');
            $user_id = $result->row()->id;
            $authObj = array (
                'user_id' => $user_id
            );
            $this->db->where('id', $this->session->userdata('auth_id'));
            $this->db->update('auths', $authObj);
            $this->session->set_userdata('user_id', $user_id);
            echo '{"result": true}';
        } else {
            echo '{"result": false, "message": "login failed"}';
        }
    }

    public function register() {
        $userObj = array (
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'pwd_salt' => $_POST['password'],
            'email_salt' => hash_hmac('sha256', $this->generateRandomString(), 'email_activate')
        );
        $result = $this->db->query("select * from users where username = ? or email = ?", array($userObj['username'], $userObj['email']));
        if ($result->row()) {
            echo '{"result" : false, "message": "user already exists"}';
        } else {
			$this->load->library('session');
			$this->db->insert("users", $userObj);
            $user_id = $this->db->insert_id();
            $authObj = array (
                'user_id' => $user_id
            );
            $this->db->where('id', $this->session->userdata('auth_id'));
            $this->db->update('auths', $authObj);
            $this->session->set_userdata('user_id', $user_id);
            // add a score record for the user
            $this->load->library('scorecard');
            $this->scorecard->create_user_score($user_id);
            $this->sendEmailVerification($userObj);
            echo '{"result": true}';
        }
    }

    public function sendEmailVerification($userObj) {
        try {
            $recipient[$userObj["username"]] = $userObj["email"];
            $activate_link = $this->config->base_url() . 'main/activate/' . $userObj['email_salt'];
            $data = Array('name' => $userObj["username"], 'activate_link' => $activate_link);
            $this->email_model->send($recipient, "Please Confirm Your Email Address, %name%", "email_verification", $data);
        } catch (Exception $e) {
            echo '{"result" : false, "message": "'. $e->getMessage() . '"}';
            return;
        }
    }

    public function activate($email_salt='') {
        if (!empty($email_salt)) {
            $result = $this->db->query("select * from users where email_salt = ?", $email_salt);
            if ($result->row()) {
                $this->db->query("update users set email_salt='' where email_salt = ?", $email_salt);
                $recipient[$result->row()->username] = $result->row()->email;
                $data = Array('name' => $result->row()->username);
                $this->email_model->send($recipient, "Welcome to Marketingbazar, %name%", "welcome", $data);
                header('Location: /');
                return;
            }
        }
        header('HTTP/1.0 404 Not Found');
        echo "<h1>ERROR 404</h1><h2>Invalid Address</h2>";
        return;
    }

	public function logout() {
		$sessionData = $this->session->all_userdata();
		$providername = array_key_exists('provider', $sessionData) ? $sessionData['provider'] : '';
		$token = array_key_exists('token', $sessionData) ? $sessionData['token'] : '';
		$this->executeLogout($providername, $token);
	}

	private function executeLogout($providername, $token) {
        $this->load->library('session');
		$this->config->load('oauth', TRUE);
        $oauthConfig = $this->config->item('oauth');
		$key = $oauthConfig[$providername]['key'];
		$secret = $oauthConfig[$providername]['secret'];
		$this->load->helper('url_helper');
		$redirect_uri = base_url();
		if ($providername == "facebook") {
			$base_url = "https://www.facebook.com/logout.php";
			$params = array('next' => $redirect_uri, 'access_token' => $token);
			$url = $base_url . '?' . http_build_query($params);
			header('Location: ' . $url);
			$this->session->sess_destroy();
		} else if ($providername == "linkedin") {
			$base_url = "https://www.linkedin.com/uas/connect/logout";
			$params = array('oauth_token' => $token, 'api_key' => $key, 'callback' => $redirect_uri);
			$data['url'] = $base_url . '?' . http_build_query($params);
			$this->load->view('blank', $data);
			$this->session->sess_destroy();
			header('Location: ' . $redirect_uri);
		} else if ($providername == "google") {
			$base_url = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout";
			$params = array('continue' => $redirect_uri);
			$url = $base_url . '?' . http_build_query($params);
			header('Location: ' . $url);
			$this->session->sess_destroy();
		} else {
			header('Location: ' . $redirect_uri);
			$this->session->sess_destroy();
		}
	}

    private function saveData($providername, $token, $user)
    {
        $usertoken = $token->access_token;
        $usersecret = isset($token->secret) ? $token->secret : null;
        $uid = $user['uid'];
        $nickname = array_key_exists('nickname', $user) ? $user['nickname'] : $uid;
        $name = array_key_exists('name', $user) ? $user['name'] : null;
        $location = array_key_exists('location', $user) ? $user['location'] : null;
        $description = array_key_exists('description', $user) ? $user['description'] : null;
        $profileimage = array_key_exists('image', $user) ? $user['image'] : null;
        $email = array_key_exists('email', $user) ? $user['email'] : '';
        $userobj = array(
            'username' => $nickname,
            'uid' => $uid,
            'name' => $name,
            'email' => $email,
            'location' => $location,
            'token' => $usertoken,
            'secret' => $usersecret,
            'provider' => $providername,
            'summary' => $description,
            'profileimage' => $profileimage
        );

        $this->load->helper('url');
        $result = $this->db->query("select * from auths where uid=? and provider=?", array(
            $uid,
            $providername
        ));

        if ($result->row()) {
            $this->db->where('id', $result->row()->id);
            $this->db->update('auths', $userobj);
            $auth_id = $result->row()->id;
        } else {
            $this->db->insert('auths', $userobj);
            $auth_id = $this->db->insert_id();
        }

        $this->load->library('session');
        $this->session->set_userdata($userobj);

        $result = $this->db->query("select * from auths where id=?", $auth_id);
        if ($result->row()) {
            $user_id = $result->row()->user_id;
        } else {
            $user_id = 0;
        }
        $this->session->set_userdata('auth_id', $auth_id);
        $this->session->set_userdata('user_id', $user_id);

        $sessionobj = array(
            'id' => $this->session->userdata('session_id'),
            'auth_id' => $auth_id,
            'ip_address' => $this->session->userdata('ip_address'),
            'user_agent' => $this->session->userdata('user_agent'),
            'last_activity' => $this->session->userdata('last_activity'),
            'user_data' => http_build_query($this->session->all_userdata())
        );

        $result = $this->db->query("select * from sessions where id=?", $this->session->userdata('session_id'));
        if ($result->row()) {
            $this->db->where('id', $this->session->userdata('session_id'));
            $this->db->update('sessions', $sessionobj);
        } else {
            $this->db->insert('sessions', $sessionobj);
        }

        redirect('/', 'refresh');
	}

    private function generateRandomString($length = 100) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
