<div id="header">

        <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="<?PHP echo Router::url('/', true); ?>">
                    <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Logo" style="height: 50px;" />
                </a>
                <div class="nav-no-collapse">                
                    <ul class="nav">
                        <li><a href="<?PHP echo Router::url('/', true); ?>"><span class="icon16 icomoon-icon-screen-2"></span> <span class="txt">Página Inicial</span></a></li>
                    </ul>
                  
                    <ul class="nav pull-right usernav">
                        <li class="dropdown">
                            <!--
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-bell"></span><span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul class="notif">
                                        <li class="header"><strong>Notifications</strong> (3) items</li>
                                        <li>
                                            <a href="#">
                                                <span class="icon"><span class="icon16 icomoon-icon-user-plus"></span></span>
                                                <span class="event">1 User is registred</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="icon"><span class="icon16 icomoon-icon-bubble-3"></span></span>
                                                <span class="event">Jony add 1 comment</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="icon"><span class="icon16 icomoon-icon-new"></span></span>
                                                <span class="event">admin Julia added post with a long description</span>
                                            </a>
                                        </li>
                                        <li class="view-all"><a href="#">View all notifications <span class="icon16 icomoon-icon-arrow-right-8"></span></a></li>
                                    </ul>
                                </li>
                            </ul>
                            -->
                        </li>
                        <li class="dropdown">
                                                
                            <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                                <?PHP
                                $img = (($userLogado['foto']<>'')?'/files/usuario/foto/'.$userLogado['foto']:'/img/logo.png');
                                echo $this->Timthumb->image($img, array('width' => 38, 'height' => 33, 'zoom_crop'=>2), array('class'=>'image'));
                                ?>
                                <!-- <img src="<?php echo $this->webroot . $img; ?>" alt="" class="image" width="38" height="33" /> --> 
                                <span class="txt"><?PHP echo $userLogado['nome']; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="menu">
                                    <ul>
                                        <li>
                                            <a href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'editar_perfil' )); ?>"><span class="icon16 icomoon-icon-user-plus"></span>Editar Perfil</a>
                                        </li>
                                        <li><a href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'logout' )); ?>"><span class="icon16 icomoon-icon-exit"></span><span class="txt"> Logout</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div><!-- /navbar --> 

    </div><!-- End #header -->