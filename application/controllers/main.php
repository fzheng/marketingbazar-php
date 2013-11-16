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
	}

	function index() {
        $this->load->helper('cookie');
        if(defined('ENVIRONMENT') && ENVIRONMENT === "prod" && !$this->input->cookie(md5("http://www.marketingbazar.com"), TRUE)) {
            header('HTTP/1.0 404 Not Found'); echo '404 = 400 + 4 = 4 * 101 = 1616 / 4 = YOU'; exit();
        }
		$sessionData = $this->session->all_userdata();
		$id = array_key_exists('id', $sessionData) ? $sessionData['id'] : null;
		if (is_null($id)) {
			$this->load->view('auth');
		} else {
			$this->load->view('home', $sessionData);
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
            $id = $result->row()->id;
        } else {
            $this->db->insert('auths', $userobj);
            $id = $this->db->insert_id();
        }

        $this->load->library('session');
        $this->session->set_userdata($userobj);
        $this->session->set_userdata('id', $id);

        $sessionobj = array(
            'id' => $this->session->userdata('session_id'),
            'auth_id' => $id,
            'ip_address' => $this->session->userdata('ip_address'),
            'user_agent' => $this->session->userdata('user_agent'),
            'last_activity' => $this->session->userdata('last_activity'),
            'user_data' => $this->session->userdata('user_data')
        );

        $result = $this->db->query("select * from sessions where id=?", $this->session->userdata('session_id'));
        if ($result->row()) {
            $this->db->where('id', $this->session->userdata('session_id'));
            $this->db->update('sessions', $sessionobj);
        } else {
            $this->db->insert('sessions', $sessionobj);
        }

        // redirect ( '/profile/editprofile', 'refresh' );
        redirect('/', 'refresh');
	}
}
