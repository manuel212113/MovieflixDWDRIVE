<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/links/active">Links</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?=ucwords($this->data['linksType'])?> Links</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <div class="row">
         <div class="col-lg-12">
            <div class="grid">
               <div class="grid-body">
                  <h5 class="mb-4"><?=ucwords($this->data['linksType'])?> Links - (<?=count($this->data['links'])?>)</h5>
                  <div class="item-wrapper">
                     <div class="table-responsive">
                        <table id="sample-data-table" class="data-table table table-striped text-center">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Título</th>
                                 <th>Fonte</th>
                                 <th>Qualidade</th>
                                 <th>Views</th>
                                 <!-- <th>Downloads</th> -->
                                 <th>Última atualização em</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php  foreach($this->data['links'] as $k =>  $link):
                                 $isDrive = $link['type'] == 'GDrive' ? true : false;
                                 
                                

                                  ?>
                              <tr id="link-<?=$link['id']?>">
                                 <td><?=$k+1?></td>
                                 <td> 
                                    <a href="<?=Main::getPlyrLink($link['slug'])?>" target="_blank" class="text-reset"><?=$link['title']?></a> 
                                 </td>
                                 <td> 
                                    <img src="<?=getThemeURI()?>/assets/images/icons/<?=$link['type']?>.png" height="15" alt="source-icon"> 
                                 </td>
                                 <td>
                                    <?php 
                                     $qualities = '--';
                                       if($isDrive && !empty($link['data'])){
                                          $qt = Main::getQulities($link['data']);
                                          $qualities = implode(', ', $qt);
                                       }
                                    ?>

     
                                     <span class="badge badge-pill badge-inverse-dark"><?=$qualities?></span>
                                 </td>
                                 <td><?=$link['views']?></td>
                                 <td><?=Main::dateFormat($link['updated_at'])?></td>
                                 <td>
                                 <?php if(self::$config['streamLink']): ?>
                                    <?php if($isDrive): ?>
                                       <button type="button" class="btn btn-inverse-dark btn-xs px-1 copy-stream-link" data-url="<?=Main::getStreamLink($link['slug'], $qt[0])?>" title="copy stream link"><i class="mdi mdi-link-variant"></i></button>
                                    <?php else: ?>
                                       <button type="button" class="btn  btn-xs px-1 disabled" data-url="#" title="copy stream link" disabled><i class="mdi mdi-link-variant"></i></button>
                                    <?php endif; ?>
                                 <?php endif; ?>

                                    <button type="button" class="btn btn-inverse-dark btn-xs px-1 copy-plyr-link" data-url="<?=Main::getPlyrLink($link['slug'])?>" title="copy player link"><i class="mdi mdi-play-box-outline"></i></button>
                                    <button type="button" class="btn btn-inverse-info btn-xs px-1 ml-1 copy-embed-code" data-url="<?=Main::getPlyrLink($link['slug'])?>" title="copy embed code"><i class="mdi mdi-code-tags"></i></button>
                                    <a href="<?=PROOT?>/links/edit/<?=$link['id']?>"  class="btn btn-inverse-success btn-xs px-1 ml-1"  title="edit"><i class="mdi mdi-pencil-box-outline"></i></a>
                                    <button type="button" class="btn btn-inverse-danger btn-xs px-1 ml-1 del-link" title="delete" data-id="<?=$link['id']?>"><i class="mdi mdi-delete-forever"></i></button>
                                 </td>
                              </tr>
                              <?php endforeach; ?>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <th>ID</th>
                                 <th>Título</th>
                                 <th>Fonte</th>
                                 <th>Views</th>
                                 <th>Downloads</th>
                                 <th>Última atualização em</th>
                                 <th></th>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->
<div class="modal fade" tabindex="-1" role="dialog" id="delete-confirmation">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header bg-warning">
            <h4 class="modal-title text-white">Atenção !</h4>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="d-flex flex-column justify-content-center align-items-center">
               <i class="mdi mdi-alert-outline mdi-6x text-warning"></i>
               <h4 class="text-black font-weight-medium mb-4">Você tem certeza?</h4>
               <p class="text-center text-dark">Tem certeza de que deseja remover este link permanentemente?</p>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-link text-black component-flat" data-dismiss="modal">Dispensar</button>
            <button type="button" class="btn btn-warning btn-sm s-del-link " data-id="">Sim, continue</button>
         </div>
      </div>
   </div>
</div>