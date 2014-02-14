<?PHP
$this_page = 'Visualização';
$this->Html->addCrumb('Você está aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o início', 'class' => 'tip'));

$this->Html->addCrumb( $title_for_layout, $base_url );
$this->Html->addCrumb( $this_page );
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box invoice">
            <div class="title">
                <h4><span><?php echo __( $this_page ); ?></span></h4>   
            </div>
            
            <div class="content">   
                
                <div class="you">
                    <ul class="unstyled">
                        <li><h3><?PHP echo $Arquivo['Arquivo']['titulo']; ?></h3></li>
                        <li><span class="icon16 icomoon-icon-arrow-right-3"></span>Categoria: <?PHP echo $Arquivo['CategoriaArquivo']['titulo']; ?></li>
                        <?PHP echo (($Arquivo['Arquivo']['descricao']<>'')? '<li><span class="icon16 icomoon-icon-arrow-right-3"></span>'. $Arquivo['Arquivo']['descricao'] .'</li>':''); ?>
                        <li><span class="icon16 icomoon-icon-arrow-right-3"></span><?php echo $this->Html->link( '<i class="icon16 icomoon-icon-file-download mr0"></i> Download', array('action' => 'download', $Arquivo['Arquivo']['id']), array('title'=>'Editar', 'class'=>'btn','escape' => false)); ?></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                
                
                <?PHP //debug($arquivo); ?>
                
                <?PHP  echo $this->Html->link( '<i class="icon-circle-arrow-left"></i> Voltar', array('action'=>'index'), array( 'escape' => false, 'class'=>'btn' ) ); ?>
                
                <div class="invoice-footer">
                    <p>Criado em <?PHP echo $Arquivo['Arquivo']['created']; ?> | Última Alteração em <?PHP echo $Arquivo['Arquivo']['modified']; ?> </p>
                </div>
                

            </div><!-- End .content -->
        </div><!-- End .box -->
    </div><!-- End .span12 -->
</div>