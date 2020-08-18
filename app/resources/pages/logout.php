<?php
Auth::destroySession($_SESSION['auth_hash']);
print <<<END
<script type="text/javascript">location.reload();</script>
END;
