<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/member_parts/member_master_header_view');
$this->load->view('templates/member_parts/member_master_sidebar_view');
if ($this->ion_auth->logged_in()) {
	
}

?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <?php
            echo $the_view_content;
        ?>
    </section>
</section>
<!--main content end-->
<?php
$this->load->view('templates/member_parts/member_master_footer_view');
?>