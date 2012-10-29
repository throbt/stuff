<?php
  class Fb {

    public $fb;
    public $fbParams;
    public $feedId;

    function __construct() {
      require 'facebook-php-sdk/src/facebook.php';
      $this->fbParams = array(
        'appId'             => '361107870625036',
        'secret'            => 'd1d971a0e05de42564c8e1f564e9d4de'/*,
        'fileUpload'        => true,
        'cookie'            => true*/
      );
      $this->feedId = '464967983528420';
      $this->fb     = new Facebook($this->fbParams);
    }

    public function get() {
      return $this->fb;
    }

    public function addPost($message,$link) {
      try {
        $params = array(
          'message'       => $message,
          'link'          => $link,
          'access_token'  => $this->fb->getAccessToken() //$this->getAppToken()
        ); //1137589569  //361107870625036  //464967983528420  //363389167067001
        $this->fb->api("/{$this->feedId}/feed",'post', $params);  //kerekedj_fel:send
      }catch(Exception $e){
        return false;
      }
      return true;
    }

    public function getProfile($fields = '') {
      if(gettype($fields) == 'array') {
        $thisFields = implode(',',$fields);
        try {
          $fb_profile = $this->fb->api("/me?fields={$thisFields}");
          return $fb_profile;
        }catch(Exception $e){
          return false;
        }
      }
    }

    public function fbLogin($redirect_uri = '') {
      $scope = array(
        'scope' => 'share_item,manage_pages,publish_stream,publish_actions'
      );

      if($redirect_uri != '') {
        $scope['redirect_uri'] = $redirect_uri;
      }

      header('location: '.$this->fb->get_login_url($scope));
      die();
    }

    public function fbLogout($redirect_uri = '') {
      $scope = array(
        'scope' => 'share_item,manage_pages,publish_stream,publish_actions'
      );

      if($redirect_uri != '') {
        $scope['redirect_uri'] = $redirect_uri;
      }

      header('location: '.$this->fb->getLogoutUrl($scope));
      die();
    }

    public function facebookLogin($redirect_uri = '') {
      $scope = array(
        'scope' => 'share_item,manage_pages,publish_stream,publish_actions'
      );

      if($redirect_uri != '') {
        $scope['redirect_uri'] = $redirect_uri;
      }

      header('location: '.$this->fb->get_login_url($scope,'mobile'));
      die();
    }

    public function faceBookLogout($redirect_uri = '') {
      $scope = array(
        'scope' => 'share_item,manage_pages,publish_stream,publish_actions'
      );

      if($redirect_uri != '') {
        $scope['redirect_uri'] = $redirect_uri;
      }

      header('location: '.$this->fb->getLogoutUrl($scope,'mobile'));
      die();
    }

    public function getAppToken() {
      $arr = explode('access_token=',
        file_get_contents("https://graph.facebook.com/oauth/access_token?client_id={$this->fbParams['appId']}&client_secret={$this->fbParams['secret']}&grant_type=client_credentials")
      );
    return trim($arr[1]);
  }
}
?>