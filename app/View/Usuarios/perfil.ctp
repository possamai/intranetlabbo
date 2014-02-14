<?PHP
$this->Html->addCrumb('Você está aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));

$this->Html->addCrumb( $title_for_layout, $base_url  );
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box gradient">
            <div class="title clearfix">
                <h4 class="left">
                    <span class="icon16 icomoon-icon-table "></span>
                    <span>Perfil</span>
                </h4>
            </div>
                <div class="content">
                    
                    <form class="form-horizontal seperator">
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Foto:</label>
                                        <?php
                                        $img = (($usuario['Usuario']['foto']<>'')?'/files/usuario/foto/'.$usuario['Usuario']['foto']:'/img/logo.png');
                                        echo $this->Timthumb->image($img, array('width' => 100, 'height' => 100, 'zoom_crop'=> 2), array('class'=>'image marginR10'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Nome:</label>
                                        <span class="perfil blue"><?PHP echo $usuario['Usuario']['nome']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Nivel:</label>
                                        <span class="perfil blue"><?PHP echo $usuario['Nivel']['titulo']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">E-mail:</label>
                                        <span class="perfil blue"><?PHP echo $usuario['Usuario']['email']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Ramal:</label>
                                        <span class="perfil blue"><?PHP echo $usuario['Usuario']['ramal']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Aniversário:</label>
                                        <span class="perfil blue"><?PHP echo (($usuario['Usuario']['data_nascimento']<>'') ? (date('d/m', strtotime($usuario['Usuario']['data_nascimento'])). '/'. date('Y')) : ''); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Telefone:</label>
                                        <span class="perfil blue"><?PHP echo $usuario['Usuario']['telefone']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Celular:</label>
                                        <span class="perfil blue"><?PHP echo $usuario['Usuario']['celular']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Grupos:</label>
                                        <span class="perfil blue"><?php foreach($usuario['Grupos'] as $grupo) { echo $grupo['titulo'] . ', '; } ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <?PHP if ($usuario['Usuario']['assinatura']<>'') : ?>
                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3">Assinatura Digital:</label>
                                        <?php
                                        $img = '/files/usuario/assinatura/'.$usuario['Usuario']['assinatura'];
                                        echo $this->Timthumb->image($img, array('height' => 100, 'zoom_crop'=> 2), array('class'=>'marginR10'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?PHP endif; ?>

                        </form>
                    
                    
                    <?PHP // debug($usuario); ?>
                    
                    
                    
                </div>
            </div><!-- End .box -->
        </div><!-- End .span6 -->
</div>