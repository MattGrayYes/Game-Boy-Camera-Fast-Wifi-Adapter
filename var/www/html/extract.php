<?php
echo exec("su pi -c '/home/pi/get_photos.sh &'");
header("Location: /");
