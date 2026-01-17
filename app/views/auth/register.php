<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - Website Perpustakaan Kampus</title>
        <link rel="stylesheet" href="<?= BASEURL; ?>/css/template-global.css">
        <link rel="stylesheet" href="<?= BASEURL; ?>/css/template-login.css">
    </head>
    <body>
        <section>
            <div class="auth-card">
                <!-- Image Side -->
                <div class="auth-side-img">
                    <img src="https://images.unsplash.com/photo-1731200301762-af6a21e9037a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx1bml2ZXJzaXR5JTIwbGlicmFyeSUyMGJvb2tzfGVufDF8fHx8MTc2MTYwOTkzOXww&ixlib=rb-4.1.0&q=80&w=1080" alt="Library" />
                </div>
                
                <!-- Form Side -->
                <div class="auth-form-container">
                    <form action="<?= BASEURL; ?>/auth/tambah" method="post">
                        <h2>Create Account</h2>
                        
                        <!-- Flash Message -->
                        <?php Flasher::flash(); ?>

                        <div class="input-grid">
                            <!-- Full Width -->
                            <div class="col-full">
                                <p>Nama Lengkap</p>
                                <input type="text" name="nama" placeholder="Nama Lengkap" required/>
                            </div>
                            
                            <!-- Half Widths -->
                            <div class="col">
                                <p>NPM</p>
                                <input type="text" name="npm" placeholder="NN.NNNN.N.NNNNN" required/>
                            </div>
                            <div class="col">
                                <p>Username</p>
                                <input type="text" name="username" placeholder="Username" required/>
                            </div>
                            
                            <div class="col">
                                <p>Email</p>
                                <input type="email" name="email" placeholder="user@kampus.ac.id"/>
                            </div>
                            <div class="col">
                                <p>Nomor Telepon</p>
                                <input type="number" name="telp" placeholder="08XXXXXXXXXX"/>
                            </div>
                            
                            <div class="col">
                                <p>Password</p>
                                <input type="password" name="password" placeholder="Password" required/>
                            </div>
                            <div class="col">
                                <p>Ulangi Password</p>
                                <input type="password" name="password_confirm" placeholder="Ulangi Password"/>
                            </div>
                        </div>

                        <input type="submit" value="Sign Up" />
                        
                        <p class="signup">
                            Already have an account ?
                            <a href="<?= BASEURL; ?>/auth">Sign in.</a>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
