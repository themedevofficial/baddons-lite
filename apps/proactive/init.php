<?php 
namespace NbAdds\Apps\Proactive;
defined( 'ABSPATH' ) || exit;

class Nbaddons_Init{
    private static $instance;

   
    public function _init() {        
        if(current_user_can('manage_options')){
            //Nbaddons_Notices::instance()->_init();
        }  
    }


    public function activate(array $parmas ){
        $key = isset($parmas['key']) ? $parmas['key'] : '';
        if(empty(trim($key)) ){
            $result['status'] = 'danger';
            $result['message'] = esc_html__('Key is empty', 'next-addon');
            return json_encode($result); 
        }

        $parmas['eddtigger'] = 'active';
        $url = $this->get_edd_api().'/getpro?'. http_build_query($parmas, '&');
        $output = $this->_connection($url);
        if( isset($output->status) && $output->status == 'success'){
            if ( did_action( 'ddeskaddonsPro/loaded' ) ) {
                update_option('__validate_author_naddons__', 'active');
                //\DeskAddonsPro\Utilities\Proactive\Active::instance()->save_pro($key);
            }
        }
       return $output;
    }

    public function inactivate( array $parmas ){
        $key = isset($parmas['key']) ? $parmas['key'] : '';
        $parmas['eddtigger'] = 'revoke';
        $url = $this->get_edd_api().'/getpro?'. http_build_query($parmas, '&');
        $output = $this->_connection($url);
        if( isset($output->status) && $output->status == 'success'){
            return $output;
        }
       return;
    }

    private function _connection( $url ){
        $args = array(
            'timeout'     => 60,
            'redirection' => 3,
            'httpversion' => '1.0',
            'blocking'    => true,
            'sslverify'   => true,
        ); 
        $res = wp_remote_get( $url, $args );

        return (object) json_decode(
            (string) $res['body']
        ); 
    }

    public function get_edd_api(){
        return 'https://api.ddesks.com/';
    }

    public static function instance(){
		if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
	}
}