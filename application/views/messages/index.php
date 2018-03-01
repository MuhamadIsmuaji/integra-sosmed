<?php if ($this->session->flashdata('feedback_success')) { ?>

<div class="notification is-success">
    <?= $this->session->flashdata('feedback_success'); ?>
</div>

<?php } ?>
    
<?php if ($this->session->flashdata('feedback_danger')) { ?>

<div class="notification is-danger">
    <?= $this->session->flashdata('feedback_danger'); ?>
</div>

<?php } ?>