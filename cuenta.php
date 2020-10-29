<?php
    
    session_start();
    if(isset($_SESSION['admin'])){
        include('cabeza.php');  
        include_once 'conexion.php';
        if($_POST){
            $firstname = $_POST['firstname'];
            $company = $_POST['company'];
            $email = $_POST['email'];
            $lastname = $_POST['lastname'];
            $adress = $_POST['adress'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $aboutme = $_POST['aboutme'];
            $postcode = $_POST['postcode'];
            $id = $_SESSION['id'];
            try{
                $sql = 'UPDATE users SET firstname=?,lastname=?,enterprise=?,email=?,lastname=?,adress=?,country=?,city=?,aboutme=?,postcode=? where id=?';
                $sentencia = $pdo->prepare($sql);
                $sentencia->execute(array($firstname,$lastname,$company,$email,$lastname,$adress,$country,$city,$aboutme,$postcode,$id));
                
                $sql2 = 'SELECT * from users where id='.$id;
                $sentencia2 = $pdo->prepare($sql2);
                $sentencia2->execute();
                $resultado = $sentencia2->fetch();
                $_SESSION['firstname'] = $resultado['firstname'];
                $_SESSION['enterprise'] = $resultado['enterprise'];
                $_SESSION['email'] = $resultado['email'];
                $_SESSION['lastname'] = $resultado['lastname'];
                $_SESSION['adress'] = $resultado['adress'];
                $_SESSION['country'] = $resultado['country'];
                $_SESSION['city'] = $resultado['city'];
                $_SESSION['aboutme'] = $resultado['aboutme'];
                $_SESSION['postcode'] = $resultado['postcode'];
            }catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            
        }
    
       
        //$_SESSION['firstname'] = $resultado['firstname'];
   
?>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Perfil</h4>
                            </div>
                            <div class="content">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Compañía </label>
                                                <input type="text" class="form-control"  placeholder="Company" name="company" value="<?php echo $_SESSION['enterprise']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username (disabled)</label>
                                                <span style="display:none;" id="username"><?php echo $_SESSION['username']?></span>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="<?php echo $_SESSION['username']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $_SESSION['email']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="Company" name="firstname" value="<?php echo $_SESSION['firstname']?>">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $_SESSION['lastname']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Home Address" name="adress" value="<?php echo $_SESSION['adress']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $_SESSION['city']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" placeholder="Country" name="country" value="<?php echo $_SESSION['country']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control" name="postcode" value="<?php echo $_SESSION['postcode']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control" placeholder="Here can be your description" name="aboutme" value="<?php echo $_SESSION['aboutme']?>"><?php echo $_SESSION['aboutme']?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/moises.jpg" alt="..."/>

                                      <h4 class="title"><?php echo $_SESSION['firstname']?><br />
                                         <small><?php echo $_SESSION['username']?></small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> <?php echo $_SESSION['aboutme']?>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

 <?php
    include('pie.php');
  }
  else{
      header('Location:login.php');
  }
 
?>
<script type="text/javascript">
        var username = document.getElementById("username") 
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-id',
            	message: username.innerHTML+", cuentas con datos actualizados"

            },{
                type: 'info',
                timer: 4000
            });

        });
       
	</script>