    <div class="container-fluid">
        <div id="header">
            <div class="row-fluid">
                <div class="navbar">
                    <div class="navbar-inner">
                      <div class="container">
                            <a class="brand" href="<?PHP echo Router::url('/', true); ?>">
                                <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Logo" />
                            </a>
                      </div>
                    </div><!-- /navbar-inner -->
                  </div><!-- /navbar -->
            </div><!-- End .row-fluid -->

        </div><!-- End #header -->
    </div><!-- End .container-fluid -->    

    <div class="container-fluid">

        <div class="loginContainer">
            <!-- BEGIN LOGIN FORM -->
<?php echo $this->Form->create('Usuario', array(
            'class'=>'form-horizontal',
            'id' => 'loginForm',
            'inputDefaults' => array(
                'label' => false,
                'div' => false,
                'class' => 'span12 uniform-input'
            )
) ); ?>
      
            <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <?php echo $this->Session->flash(); ?>
                            
                            <label class="form-label span12" for="UsuarioLogin">Usuário:<span class="icon16 icomoon-icon-user right gray marginR10"></span></label>
                            <?PHP echo $this->Form->input('login', array('class'=>'input-block-level', 'tabindex'=>'1', 'required' => 'required')); ?>
                        </div>
                    </div>
                </div>

                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="UsuarioPassword">
                                Senha:
                                <span class="icon16 icomoon-icon-lock right gray marginR10"></span>
                                <span class="forgot">
                                
                                <?PHP
                                echo $this->Html->link( 'Esqueceu sua senha?', 'javascript:;',
                                    array('title'=>'Esqueceu sua senha?')
                                );
                                ?></span>
                            </label>
                            <?PHP echo $this->Form->input('password', array('class'=>'input-block-level', 'tabindex'=>'2')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-row row-fluid">                       
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="form-actions">
                            <div class="span12 controls">                                
                                <?PHP
                                echo $this->Html->link( '<span class="icon16 icomoon-icon-enter white"></span> Entrar', 'javascript:;',
                                    array('title'=>'Salvar', 'id' => 'back', 'tabindex'=>'3', 'class'=>'btn btn-info bt_salvar right', 'escape' => false)
                                );
                                ?>
                                <!-- <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Entrar</button> -->
                            </div>
                            </div>
                        </div>
                    </div> 
                </div>
            <?php echo $this->Form->end(array('div' => false, 'class'=>'nostyle', 'style' => 'position: absolute; left: -99999999px; width: 1px; height: 1px;' )); ?>
        </div>

    </div><!-- End .container-fluid -->


     <script type="text/javascript">
        $(document).ready(function() {
            $('#UsuarioLogin').focus();
            $("input, textarea, select").not('.nostyle').uniform();
        });
    </script>