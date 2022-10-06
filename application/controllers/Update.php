<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {
    function __construct() {
        parent::__construct();


    }

	public function index()
	{
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, user-scalable=no" />

        </head>
        <body>
        <center>
            <h3>CBT Sedang di download</h3>
            <p>Proses download cbt versi terbaru akan berlangsung secara otomatis, jika tidak klik <a href="<?php echo base_url("download/android");?>">link download ini secara manual</a>.</p>
        </center>
        <script type="text/javascript">
            location.href = '<?php echo base_url("download/android");?>'
        </script>

        </body>
        </html>

        <?php
	}

}
