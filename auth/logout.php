<?php
// auth/logout.php

require_once __DIR__ . '/jwt_config.php';

clearTokenCookie();

header('Location: ../login.html');
exit;