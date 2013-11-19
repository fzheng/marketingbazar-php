<!DOCTYPE html>
<html lang="en">
<head>
    <title>Marketingbazar: our slogan, our service, our future</title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="./www/css/base.css" type="text/css" media="all">
    <!--[if lt IE 9 ]>
    <link rel="stylesheet" href="./www/css/720_grid.css" type="text/css"><![endif]-->
    <link rel="stylesheet" href="./www/css/720_grid.css" type="text/css" media="screen and (min-width: 720px)">
    <link rel="stylesheet" href="./www/css/986_grid.css" type="text/css" media="screen and (min-width: 986px)">
    <link rel="stylesheet" href="./www/css/1236_grid.css" media="screen and (min-width: 1236px)" >
    <script type="text/javascript" src="./www/js/picturefill.js"></script>
</head>
<body>
<div class="banner-wrap">
    <div class="banner">
        <h3>Welcome to Marketingbazar Dashboard, <? echo empty($name) ? 'Guest' : $name;?></h3>
    </div>
</div>
<div class="grid">
    <div class="row">
        <div class="slot-0 feature">
            <div class="row">
                <img src="<? echo empty($profileimage) ? './www/images/dummyUser.png' : $profileimage; ?>"/>
            </div>
            <hr/>
            <div class="row">
                <p><? echo empty($name) ? 'Guest' : $name; ?></p>
            </div>
            <hr/>
            <div class="row">
                <p><? echo empty($user_id) ? 'EMPTY ID' : $user_id; ?></p>
            </div>
            <div class="row">
                <p><? echo empty($location) ? '' : $location; ?></p>
            </div>
            <div class="row">
                <p><? echo empty($email) ? '' : $email; ?></p>
            </div>
            <div class="row">
                <p><? echo empty($summary) ? '' : $summary; ?></p>
            </div>
            <hr/>
             <div class="row">
                <a href="/competitions">View Your Competitions</a>
            </div>
            <hr/>
            <div class="row">
                <a href="/accounts/profile">Your Profile</a>
            </div>
            <hr/>
             <div class="row">
                <a href="/competitions/search">View Active Competitions</a>
            </div>            
            <hr/>           
            <div class="row">
                <a href="/main/logout">SIGN OUT</a>
            </div>
            <hr/>
            <div class="row">
                <?
                    $url = "http://freegeoip.net/json/" . $_SERVER['REMOTE_ADDR'];
                    $ret = file_get_contents($url);
                    if (!empty($ret)) {
                        try {
                            $obj = json_decode($ret);
                            echo $obj->city . ', ' . $obj->region_code . '<br>';
                            echo $obj->country_name;
                        } catch(Exception $e) {
                            echo 'exception';
                        }
                    } else {
                        echo 'empty';
                    }
                    ?>
            </div>
        </div>
        <div class="slot-1-2-3-4-5 feature">
            <div style="background: #00a9c2; color: #fff; padding: 12px">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum velit diam, vitae convallis nulla mollis eu. Sed non egestas dolor. Etiam eu arcu placerat nisl congue bibendum et nec justo. Curabitur varius quis enim eu accumsan. Ut id dapibus mauris, congue placerat lectus. Quisque ut ante rutrum, lacinia erat at, pretium ante. Aliquam ornare nec nulla pulvinar faucibus. Suspendisse egestas arcu et orci fermentum vestibulum. Aenean porttitor id arcu at dignissim. Integer vestibulum augue nisl, nec vulputate nunc lobortis vel. Proin iaculis adipiscing massa vitae faucibus. Ut congue nulla sit amet tellus auctor, non mattis nisi imperdiet. Suspendisse vehicula massa a semper mollis. Cras vitae sapien fringilla, feugiat metus at, porta nibh. Aliquam mollis adipiscing lectus a molestie. Duis facilisis in velit ut gravida. Quisque in sem nec leo eleifend tristique eget ut erat. Curabitur faucibus arcu a mi porttitor, a tincidunt lorem cursus. Vestibulum facilisis justo ut odio scelerisque faucibus. Proin tellus diam, viverra at arcu sit amet, commodo mattis mi. Aliquam erat volutpat. Donec aliquet vitae dui vitae blandit. Integer eget nibh luctus, tristique eros non, sollicitudin nibh. Duis aliquam convallis nibh, quis iaculis enim tempor nec. Suspendisse rhoncus lacinia tempus. Sed ut leo mi. Proin rhoncus eros eros, at vestibulum urna ultrices eu. Mauris sodales at orci vitae consequat. Cras arcu mi, tincidunt eleifend ante sit amet, commodo molestie sem. In justo enim, accumsan eget neque ac, congue rhoncus magna. Aliquam euismod mauris quis scelerisque scelerisque. Cras malesuada massa fringilla magna viverra rhoncus ut nec dolor. Suspendisse eu consectetur eros. Nam lacinia tortor a erat scelerisque placerat. Nunc nisi mi, vestibulum at tellus a, euismod porttitor diam. Curabitur non velit tristique, faucibus mauris non, tincidunt nibh. Nam eget urna vitae lacus varius feugiat. Sed quis massa et odio tempus sagittis. Nulla facilisi. Phasellus ante urna, pellentesque ut tempor facilisis, sagittis id nibh. Donec accumsan scelerisque lorem sit amet condimentum. Donec bibendum leo et urna condimentum tristique. Vestibulum euismod elementum dignissim. Aenean aliquam pellentesque libero, sit amet eleifend turpis suscipit sit amet. Praesent placerat ut elit et fermentum. Donec sapien diam, mollis eget mollis a, adipiscing eget neque. Proin faucibus, erat nec pulvinar ullamcorper, tortor urna malesuada velit, a feugiat diam purus eget augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vulputate adipiscing bibendum. Donec consequat tortor est, non accumsan diam tristique sed. Quisque ac elementum diam. Morbi at dignissim ipsum. Phasellus hendrerit molestie adipiscing. Pellentesque justo dolor, auctor rhoncus dignissim vitae, ullamcorper a nunc. Nunc ullamcorper purus eget lorem blandit, nec vehicula sapien blandit. Nam iaculis dolor in fermentum dictum. Morbi convallis, turpis id fermentum elementum, elit sapien consectetur mi, eget elementum velit tellus non lectus. Curabitur at lacus diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pulvinar commodo urna, nec commodo nisl laoreet quis. Curabitur vel lacus auctor, facilisis turpis a, cursus lectus. Proin sit amet lacus tempor libero luctus porttitor in et justo. Sed convallis massa eu risus hendrerit malesuada. Donec diam erat, rutrum eget justo et, elementum lobortis turpis. Nam consectetur, enim ac accumsan blandit, sapien sapien dignissim felis, sit amet mattis purus neque a purus. Vivamus vel est sit amet nunc cursus pulvinar et eget metus. Nulla auctor sagittis augue, eget luctus velit dignissim rutrum. Donec vitae pretium neque, mollis gravida dolor.
            </div>
        </div>
    </div>
</div>
<div class="empty"></div>
<div class="row footer" style="padding-top: 2em; padding-bottom: 1em;">
    <div class="grid">
        <div class="row">
            <div class="slot-0-1">
                <p><a href="/">Terms & Conditions</a></p>
            </div>
            <div class="slot-2-3">
                <p><a href="/">Privacy Policy</a></p>
            </div>
            <div class="slot-4-5">
                <p>&copy; <a href="http://www.marketingbazar.com">Marketingbazar 2013</a></p>
            </div>
        </div>
    </div>
</div>
<!-- / .grid -->
</body>
</html>