<?PHP /*
<li <?PHP echo (($this->params['controller']=='usuarios')?'class=active':''); ?>><a href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'index' )); ?>">Usuários</a></li>
*/ ?>

<!--Responsive navigation button-->  
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>
        
        <!--Left Sidebar collapse button-->  
        <div class="collapseBtn leftbar">
             <a href="#" class="tipR" title="Ocultar barra lateral"><span class="icon12 minia-icon-layout"></span></a>
        </div>

        <!--Sidebar background-->
        <div id="sidebarbg"></div>
        <!--Sidebar content-->
        <div id="sidebar">

            <div class="shortcuts">
                <ul>
                    <li><a href="support.html" title="Support section" class="tip"><span class="icon24 icomoon-icon-support"></span></a></li>
                    <li><a href="#" title="Database backup" class="tip"><span class="icon24 icomoon-icon-database"></span></a></li>
                    <li><a href="charts.html" title="Sales statistics" class="tip"><span class="icon24 icomoon-icon-pie-2"></span></a></li>
                    <li><a href="#" title="Write post" class="tip"><span class="icon24 icomoon-icon-pencil"></span></a></li>
                </ul>
            </div><!-- End search -->            

            <div class="sidenav">

                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0">Menu</h5>
                </div><!-- End .sidenav-widget -->

                <div class="mainnav">
                    <ul>
                    
                        <li><a <?PHP echo (($this->params['controller']=='dashboard')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'dashboard', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-home-2  "></span>Início</a></li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-file-6"></span>Arquivos</a>
                            <ul class="sub">
                            
<?PHP if ($userLogado['nivel_id']==1): ?>
                                <li><a <?PHP echo (($this->params['controller']=='categoria_arquivos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'categoria_arquivos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-list-2 "></span>Categorias</a></li>
<?PHP endif; ?>
                                <li><a <?PHP echo (($this->params['controller']=='arquivos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'arquivos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-file-6"></span>Arquivos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-users"></span>Usuários</a>
                            <ul class="sub">
<?PHP if ($userLogado['nivel_id']==1): ?>
                                <li><a <?PHP echo (($this->params['controller']=='grupos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'grupos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-users"></span>Grupos</a></li>
                                <li><a <?PHP echo ((($this->params['controller']=='usuarios')&&(($this->params['action']=='index')||($this->params['action']=='cadastro')))?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'index', 'status'=>2 )); ?>"><span class="icon16 icomoon-icon-user"></span>Usuários</a></li>
<?PHP endif; ?>
                                <li><a <?PHP echo ((($this->params['controller']=='usuarios')&&($this->params['action']=='aniversariantes'))?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'aniversariantes' )); ?>"><span class="icon16 icomoon-icon-gift"></span>Aniversariantes</a></li>
                                <li><a <?PHP echo ((($this->params['controller']=='usuarios')&&($this->params['action']=='ramais'))?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'ramais' )); ?>"><span class="icon16 icomoon-icon-phone "></span>Ramais</a></li>
                            </ul>
                        </li>
                        
<?PHP if ($userLogado['nivel_id']==1): ?>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-bullhorn "></span>Produtos</a>
                            <ul class="sub">
                                <li><a <?PHP echo (($this->params['controller']=='unidade_medidas')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'unidade_medidas', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-rulers"></span>Unidades de Medidas</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='cores')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'cores', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-list-2 "></span>Cores</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='lado_adesivos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'lado_adesivos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-list-2 "></span>Lado Adesivos</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='materiais')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'materiais', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-list-2 "></span>Materiais</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='rebaixos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'rebaixos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-list-2 "></span>Rebaixos</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='categoria_produtos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'categoria_produtos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-list-2 "></span>Categorias</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='produtos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'produtos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-puzzle "></span>Produtos</a></li>
                            </ul>
                        </li>
                                                 
                        <li>
                            <a href="#"><span class="icon16  icomoon-icon-cogs "></span>Sistema</a>
                            <ul class="sub">
                                <li><a <?PHP echo (($this->params['controller']=='tipo_enderecos')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'tipo_enderecos', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-tree-3"></span>Tipos de Endereços</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='tipo_acoes')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'tipo_acoes', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-tree-3"></span>Tipos de Ações</a></li>
                                <li><a <?PHP echo (($this->params['controller']=='niveis')?'class=current':''); ?>  href="<?PHP echo Router::url(array('controller' => 'niveis', 'action' => 'index' )); ?>"><span class="icon16 icomoon-icon-tree-3"></span>Níveis de Usuário</a></li>
                            </ul>
                        </li>
<?PHP endif; ?>
                        <li><a href="<?PHP echo Router::url(array('controller' => 'usuarios', 'action' => 'logout' )); ?>"><span class="icon16 icomoon-icon-exit"></span>Sair</a></li>
                    </ul>
                </div>
            </div><!-- End sidenav -->

        </div><!-- End #sidebar -->