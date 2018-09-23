<?php

	funtion createInvest($investor, $proj_id, $amount) {
		INSERT into invest(investor, proj_id, amount) VALUES( '$investor', '$proj_id', '$amount');
	}
?>
	