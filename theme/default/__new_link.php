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
            <li class="breadcrumb-item active" aria-current="page">Novo Link</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <!-- Page contents here -->
      <form id="linkForm" data-id="newForm" method="POST" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-8">
               <div class="grid">
                  <p class="grid-header">Criar novo link</p>
                  <div class="grid-body">
                     <?php $this->displayAlerts(); ?>
                     <div class="item-wrapper">
                        <div class="form-group">
                           <label for="inputEmail1">Título </label>
                           <input type="text" class="form-control" name="title" id="" placeholder="Enter file name">
                        </div>
                        <div class="form-group">
                           <label for="inputEmail1">Link Principal <sup>*</sup> </label>
                           <input type="url" class="form-control" name="main_link" placeholder="Enter your main link">
                           <small>*Fontes Suportadas : <i>Direct Link, GDrive, GPhoto, OneDrive</i> </small>
                        </div>
                        <div class="form-group">
                           <label for="inputPassword1">Alternative Link</label>
                           <input type="url" class="form-control" name="alt_link" id="" placeholder="Enter alternative link">
                           <small>*Fontes Suportadas : <i>Direct Link, GDrive</i> </small>
                        </div>
                        <div id="subList">
                           <div class="row ui-state-default ">
                              <div class="col-lg-4">
                                 <div class="mb-3">
                                    <select class="custom-select subLabel" name="sub[1][label]">
                                       <?php    
                                          $subLables = json_decode(self::$config['sublist'], true);
                                          foreach($subLables as $sublbl):
                                          ?>
                                       <option value="<?=$sublbl?>"><?=ucwords($sublbl)?></option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                                 <div class="mb-3">
                                    <div class="input-group mb-2" style="justify-content: space-between;">
                                       <input type="file" class="subFile" name="sub[1][file]">
                                       <span class="input-group-text" style="cursor:move">
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                             <path stroke="none" d="M0 0h24v24H0z"></path>
                                             <polyline points="16 4 20 4 20 8"></polyline>
                                             <line x1="14" y1="10" x2="20" y2="4"></line>
                                             <polyline points="8 20 4 20 4 16"></polyline>
                                             <line x1="4" y1="20" x2="10" y2="14"></line>
                                             <polyline points="16 20 20 20 20 16"></polyline>
                                             <line x1="14" y1="14" x2="20" y2="20"></line>
                                             <polyline points="8 4 4 4 4 8"></polyline>
                                             <line x1="4" y1="4" x2="10" y2="10"></line>
                                          </svg>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <button type="button" class="add-sub btn btn-xs btn-outline-secondary">Adicionar legenda</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="grid">
                  <div class="grid-body">
                     <div class="item-wrapper">
                        <div class="form-group">
                           <label for="inputEmail1">Imagem de capa </label>
                           <input type="file"  name="preview_img" id="">
                        </div>
                        <div class="form-group">
                           <label for="">Nome personalizado</label>
                           <input type="text" name="slug" class="form-control" id="" placeholder="Enter custom video slug">
                        </div>
                        <div class="form-group">
                           <label for="inputPassword1">Status do link</label>
                           <select name="status" class="custom-select">
                              <option value="0" selected="">Ativo</option>
                              <option value="1">Inativo</option>
                           </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-0">Salvar link</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- content viewport ends -->
<div class="row ui-state-default d-none" id="fiuop">
   <div class="col-lg-4">
      <div class="mb-3">
         <select class="custom-select subLabel" name="sub[1][label]">
            <?php    
               $subLables = json_decode(self::$config['sublist'], true);
               foreach($subLables as $sublbl):
               ?>
            <option value="<?=$sublbl?>"><?=ucwords($sublbl)?></option>
            <?php endforeach; ?>
         </select>
      </div>
   </div>
   <div class="col-lg-8">
      <div class="mb-3">
         <div class="input-group mb-2" style="justify-content: space-between;">
            <input type="file" class="subFile" name="sub[1][file]">
            <span class="input-group-text" style="cursor:move">
               <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z"></path>
                  <polyline points="16 4 20 4 20 8"></polyline>
                  <line x1="14" y1="10" x2="20" y2="4"></line>
                  <polyline points="8 20 4 20 4 16"></polyline>
                  <line x1="4" y1="20" x2="10" y2="14"></line>
                  <polyline points="16 20 20 20 20 16"></polyline>
                  <line x1="14" y1="14" x2="20" y2="20"></line>
                  <polyline points="8 4 4 4 4 8"></polyline>
                  <line x1="4" y1="4" x2="10" y2="10"></line>
               </svg>
            </span>
         </div>
      </div>
   </div>
</div>