<?php

require 'config/bootstrap.php';
//Use cron job  for run script every 10 minutes
Router::call('web/routes.php')->from(Request::url());







