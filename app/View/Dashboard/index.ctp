<?PHP
$this->Html->addCrumb('Você está aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));
?>

<div class="row-fluid">

    <div class="span8">
        <div class="reminder box gradient">
            <div class="title">
                <h4>Mural de Notificações</h4>            
            </div>        
            <div class="content">
                <ul>
                    <?PHP
                    if (count($notificacoes)>0) {
                        foreach($notificacoes as $obj) {
                            
                            echo '                        
                            <li class="clearfix">
                                <div class="icon">
                                    <span class="icon32 icomoon-icon-file-6 blue"></span>
                                </div>
                                '. $this->Html->link( 'Acessar', array('controller' => Inflector::pluralize($obj['Notificacao']['model_registro']) , 'action' => 'ver', $obj['Notificacao']['id_registro']), array('title'=>'Acessar', 'class'=>'btn btn-info', 'escape' => false)) .'
                                <div class="descricao">
                                
                                    <span class="blue">' . $this->Html->link( $obj['Criado']['nome'] , array('controller' => 'usuarios' , 'action' => 'perfil', $obj['Criado']['id']), array('title'=>'Perfil')) . '</span>
                                    
                                    <span>'. $obj['TipoAcao']['titulo'] .' </span>
                                    <span class="blue">'. $obj['Notificacao']['model_registro'] .'</span>
                                    
                                    <br />
                                    <span>Nome: '. $obj[0]['Arquivo']['titulo'] .'</span>
                                    
                                    <br />
                                    <small>Data: '. $obj['Notificacao']['created'] .'</small>
                                </div>
                            </li>   
                            
                            ';
                        }     
                    } else {
                        echo '                        
                            <li class="clearfix">
                                <div class="icon" style="margin-bottom:10px;">
                                    <span class="icon32 icomoon-icon-flag-3  blue"></span>
                                </div>
                                    <span class="number">0</span>
                                    <span>notificação a ser exibida.</span>
                            </li>   
                            
                            ';
                        
                    }           
                    //debug( $notificacoes );
                    ?>                        
                </ul>
                                                
            </div>
        </div><!-- End .reminder -->

    </div><!-- End .span8 -->
    
    
    <div class="span4">
        <div class="box gradient">
            <div class="title">
                <h4>
                    <span class="icon16 icomoon-icon-gift"></span>
                    <span>Aniversariantes da Semana</span>
                </h4>
            </div>
            <div class="content">
                
                <ul class="unstyled">
                <?PHP 
                if (count($aniversariantes)>0) {
                    foreach($aniversariantes as $user) {
                        $nome = date('d/m',strtotime($user['Usuario']['data_nascimento'])) .'/'.date('Y') . ' - ' . $user['Usuario']['nome'];                                                
                        echo '<li><span class="icon12 typ-icon-pin blue"></span>
                            '. $this->Html->link( $nome, array('controller' => 'usuarios' , 'action' => 'perfil', $user['Usuario']['id']), array('title'=>'Perfil')) .'
                        </li>';
                    }
                } else {
                    echo '<li><span class="icon12 typ-icon-pin blue"></span>Nenhum aniversariante.</li>';
                }
                
                //debug($aniversariantes); ?>  
                </ul>
                
            </div>

        </div><!-- End .box -->

    </div>
    
    
</div><!-- End .row-fluid -->