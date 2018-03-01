<?php

if (isset($header)) {
    $this->load->view($header);
}

$this->load->view($content);

if (isset($footer)) {
    $this->load->view($footer);
}
