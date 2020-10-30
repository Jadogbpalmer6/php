<?php

//pathinfo and SERVER['PHP_SELF'] can be used for routing purposes
echo json_encode(pathinfo($_SERVER['PHP_SELF']));
