<section class="hero is-light is-bold has-text-centered">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Belum Punya Akun ?</h1>
            <h2 class="subtitle">Buat akunmu sekarang, bergabung dan posting status yang luar biasa!</h2>
        </div>
    </div>
</section>

<div class="container section">
    <div class="columns">
        <div class="column is-6 is-offset-3">
            <div class="box">
                <?php $this->load->view('messages/index') ?>                
                <form method="post" action="<?=base_url('register')?>">
                    <div class="field">
                        <label class="label">Nama Lengkap</label>
                        <div class="control">
                            <input class="input" type="text" name="name" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="text" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Password</label>
                        <div class="control">
                            <input class="input" type="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Konfirmasi Password</label>
                        <div class="control">
                            <input class="input" type="password" name="passwordconf" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                    <div class="field is-grouped is-grouped-right">
                        <div class="control">
                            <input type="submit" value="Daftar" class="is-pulled-right button is-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>