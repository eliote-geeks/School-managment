   <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.php" class="logo"><?=$_SESSION['user_name']?> <span class="lite">admin&copy;</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form" method="get" action="">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>
      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- task notificatoin end -->
          <!-- inbox notificatoin start-->
          <li id="mail_notificatoin_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-envelope-l"></i>
                            <span class="badge bg-important"><?= $con?></span>
                        </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-blue"></div>
              <li>
                <p class="blue"><?php echo $con." menbres ne sont pas encore confirnes"?></p>
              </li>                                   
            </ul>
          </li>

          <li id="mail_notificatoin_bar" class="dropdown">
           <a href="pass.php"><u>modifier mot de passe de l'etudiant</u></a>    
            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img style="width:35px; height:35px; border-color: whitesmoke; color:springgreen;" alt="" src="img/log.ico">
                            </span>
                            <span class="username"><?= $_SESSION['user_name']?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="profile.php?id=<?$_SESSION['id']?>"><i class="icon_profile"></i> Mon Profile</a>
              </li>
              <li>
                <a href="logout.php"><i class="icon_key_alt"></i> Deconnexion</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="index.php?id=<?$_admin['id']?>">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class=" far fa-save"></i>
                          <span>Inscription</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="etudiant.php">etudiant</a></li>
            <?php   if(isset($admin['grade']) AND $admin['grade'] == 'root') {?>  <li><a class="" href="admin.php">admin</a></li> 
              <li><a class="" href="enseignant.php">enseignant</a></li>
               <li><a class="" href="stage.php">stagiaire</a></li>
               <?php  } ?>
               <li><a class="" href="auto.php">auto ecole</a></li>
            </ul>
          </li>

          <?php   if($admin['grade'] == 'root') {?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class=" far fa-thumbs-up"></i>
                          <span>Le Personel</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="li_en.php">Enseignant</a></li>
              <li><a class="" href="li_ca.php">Candidats Permis B</a></li>

              
            </ul>
          </li>
        <?php } ?>




          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class=" fab fa-dochub"></i>
                          <span>Discipline</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="sanction.php">sanction</a></li>
              <li><a class="" href="sanction.php">absence</a></li>
            </ul>
          </li>

<?php   if($admin['grade'] == 'root') {?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class=" fab fa-medium-m"></i>
                          <span>module</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="module.php">ajout/suppression</a></li>
              <li><a class="" href="listemodule.php">Afficher tout</a></li>
              
            </ul>
          </li>
        <?php } ?>

          <?php   if($admin['grade'] == 'root') {  ?>
          <li class="sub-menu">
            <a class="" href="javascript:;">
                          <i class="icon_genius"></i>
                          <span>filieres</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                     </a>
                           <ul class="sub">
                <li><a class="" href="cycle.php">ajout un cycle</a></li>
              <li><a class="" href="ajout.php">ajout matiere</a></li>
              <li><a class="" href="cy_a.php">liste des cycles</a></li>
              <li><a class="" href="filiere.php">liste des matieres</a></li>
              </ul> 
          </li>
        <?php   } ?>

          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class=" fab fa-cuttlefish"></i>
                          <span>Classes</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="session.php">session</a></li>
              <li><a class="" href="annee.php">Annee scolaire</a></li>
              <li><a class="" href="classe.php">classes</a></li>
                <li><a class="" href="liste.php">total</a></li>
                <li><a class="" href="calendar.php">Emploi de temps</a></li>

              </ul>
          </li>
<?php   if($admin['grade'] == 'root') {  ?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="far fa-money-bill-alt"></i>
                          <span>Scolarite</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="paiement.php">scolarite</a></li>
              <li><a class="" href="pension_t.php">Liste</a></li>
            </ul>
          </li>
        <?php } ?>
        <?php   if($admin['grade'] == 'root') {  ?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="far fa-share-square"></i>
                          <span>Paiement </span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="setting.php">liste de paiement</a></li>
            </ul>
          </li>
        <?php } ?>

          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="icon_documents_alt"></i>
                          <span>Notes</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="" href="note.php">note</a></li>
              <li><a class="" href="bulletin.php"><span>bullettin</span></a></li>
              <li><a class="" href="admis.php">Barbillard</a></li>
              <li><a class="" href="ac.php">Admis par classe</a></li>
            </ul>
          </li>

                  <?php   if($admin['grade'] == 'root') {  ?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
                          <i class="fas fa-laptop"></i>
                          <span>Site </span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
            <ul class="sub">
              <li><a class="fas fa-cog" href="page.php">Parametres</a></li>
              <li><a class="fas fa-cog" href="general.php">General</a></li>
            </ul>
          </li>
        <?php } ?>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

