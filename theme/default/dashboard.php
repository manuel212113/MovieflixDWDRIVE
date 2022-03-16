<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visão geral</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <!-- Page contents here -->
<?php if($isNewUpdate): ?>
   <div class="alert alert-info dismissible-alert" role="alert">
                          <b>Boas notícias:</b> Gdrive nova versão [v<?=$newV?>] está disponível agora ! 
                          
                          <a href="<?=PROOT?>/settings/update" class="text-dark">Atualize agora</a>
                          <i class="alert-close mdi mdi-close"></i></div>
<?php endif; ?>


      <div class="row">
         <div class="col-lg-3 equel-grid">
            <div class="grid d-flex flex-column align-items-center justify-content-center">
               <div class="grid-body text-center">
                  <div class="profile-img img-rounded bg-inverse-primary no-avatar component-flat mx-auto mb-4">
                     <i class="mdi mdi-link-variant mdi-2x"></i>
                  </div>
                  <h2 class="font-weight-medium">
                     <span class="animated-count"><?=$data['totalLinks']?></span>
                  </h2>
                  <small class="text-gray d-block mt-3">Total Links</small> 
               </div>
            </div>
         </div>
         <div class="col-lg-3 equel-grid">
            <div class="grid d-flex flex-column align-items-center justify-content-center">
               <div class="grid-body text-center">
                  <div class="profile-img img-rounded bg-inverse-success no-avatar component-flat mx-auto mb-4">
                     <i class="mdi mdi-eye mdi-2x"></i>
                  </div>
                  <h2 class="font-weight-medium">
                     <span class="animated-count"><?=$data['totalViews']?></span>
                  </h2>
                  <small class="text-gray d-block mt-3">Video Views</small> 
               </div>
            </div>
         </div>
         <div class="col-lg-3 equel-grid">
            <div class="grid d-flex flex-column align-items-center justify-content-center">
               <div class="grid-body text-center">
                  <div class="profile-img img-rounded bg-inverse-warning no-avatar component-flat mx-auto mb-4">
                     <i class="mdi mdi-download mdi-2x"></i>
                  </div>
                  <h2 class="font-weight-medium">
                     <span class="animated-count"><?=$data['totalDownloads']?></span>
                  </h2>
                  <small class="text-gray d-block mt-3">Dowloads</small> 
               </div>
            </div>
         </div>
         <div class="col-lg-3 equel-grid">
            <div class="grid d-flex flex-column align-items-center justify-content-center">
               <div class="grid-body text-center">
                  <div class="profile-img img-rounded bg-inverse-danger no-avatar component-flat mx-auto mb-4">
                     <i class="mdi mdi-link-variant-off mdi-2x"></i>
                  </div>
                  <h2 class="font-weight-medium">
                     <span class="animated-count"><?=$data['brokenLinks']?></span>
                  </h2>
                  <small class="text-gray d-block mt-3">Links quebrados</small> 
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="grid">
               <div class="grid-body py-3">
                  <p class="card-title ml-n1">Links Mais Ativos</p>
               </div>
               <div class="table-responsive">
                  <table class="table table-hover table-sm">
                     <thead>
                        <tr class="solid-header">
                           <th >Title</th>
                           <th>Views</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($data['maLinks'] as $link): ?>
                        <tr>
                           <td>                                        <a href="<?=Main::getPlyrLink($link['slug'])?>" target="_blank" class="text-reset"><?=$link['title']?></a> </td>
                           <td><?=$link['views']?></td>
                           <td>

                              <button type="button" class="btn btn-inverse-dark btn-xs px-1 copy-plyr-link" data-url="<?=Main::getPlyrLink($link['slug'])?>" title="copy player link"><i class="mdi mdi-play-box-outline"></i></button>
                              <button type="button" class="btn btn-inverse-info btn-xs px-1 ml-1 copy-embed-code" data-url="<?=Main::getPlyrLink($link['slug'])?>" title="copy embed code"><i class="mdi mdi-code-tags"></i></button>
                              <a href="<?=PROOT?>/links/edit/<?=$link['id']?>"  class="btn btn-inverse-success btn-xs px-1 ml-1"  title="edit"><i class="mdi mdi-pencil-box-outline"></i></a>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="grid">
               <div class="grid-body py-3">
                  <p class="card-title ml-n1">Links mais recentes</p>
               </div>
               <div class="table-responsive">
                  <table class="table table-hover table-sm">
                     <thead>
                        <tr class="solid-header">
                           <th >Title</th>
                           <th>Views</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($data['raLinks'] as $link): ?>
                        <tr>
                           <td>                                        <a href="<?=Main::getPlyrLink($link['slug'])?>" target="_blank" class="text-reset"><?=$link['title']?></a> </td>
                           <td><?=$link['views']?></td>
                           <td>

                              <button type="button" class="btn btn-inverse-dark btn-xs px-1 copy-plyr-link" data-url="<?=Main::getPlyrLink($link['slug'])?>" title="copy player link"><i class="mdi mdi-play-box-outline"></i></button>
                              <button type="button" class="btn btn-inverse-info btn-xs px-1 ml-1 copy-embed-code" data-url="<?=Main::getPlyrLink($link['slug'])?>" title="copy embed code"><i class="mdi mdi-code-tags"></i></button>
                              <a href="<?=PROOT?>/links/edit/<?=$link['id']?>"  class="btn btn-inverse-success btn-xs px-1 ml-1"  title="edit"><i class="mdi mdi-pencil-box-outline"></i></a>
                           </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->