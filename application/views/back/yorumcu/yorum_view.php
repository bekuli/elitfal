<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<textarea class="form-control yorum-ta"><?=$fal_data->comment?></textarea>

<script type="text/javascript">
    $(document).ready(function(){
        $(".yorum-ta").css("height", $(".yorum-ta")[0].scrollHeight+10);
    });
</script>