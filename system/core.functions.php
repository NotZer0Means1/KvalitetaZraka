<?php
set_exception_handler(array('AppCore', 'exceptionHandle'));

set_error_handler(array("AppCore",'errorExceptionHandle'));
?>