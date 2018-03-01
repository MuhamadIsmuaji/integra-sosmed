<div class="container section">
    <div class="columns">
        <div class="column is-12">
            <h1 class="title">Statusku</h1>
        </div>
    </div>
    <div class="columns">
        <div class="column is-12">
            <a href="<?= base_url('posts/create') ?>" class="button is-primary">Tambah Status</a>
        </div>
    </div>
    <div class="columns">
        <div class="column is-12">
            <?php $this->load->view('messages/index') ?>
        </div>
    </div>
    <div class="columns">
        <div class="column is-12">
            <nav class="pagination" role="navigation" aria-label="pagination"></nav>
        </div>
    </div>
    <div id="dosen_courses"></div>
</div>                

<!-- <script src="<?php echo base_url('assets/js/listdata.js'); ?>"></script> -->

<script>
    // link = [
    //     '<?php echo base_url('dosen/courses/getall'); ?>',
    // ];
    
    // var courses = new List(link, "dosenCourses");

    // function load(page) {
    //     courses.reload(page);
    // } 

    // $(() => {
    //     courses.reload(1);
    // });
</script>