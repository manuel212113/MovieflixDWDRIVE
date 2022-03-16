<?php $link = $this->data;
$isDrive = $link['type'] == 'GDrive' ? true : false; ?>

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
            <li class="breadcrumb-item active" aria-current="page">Editar Link</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <!-- Page contents here -->
      <form id="linkForm" data-id="newForm" method="POST" enctype="multipart/form-data">
         <div class="row">
            <div class="col-lg-8">
               <div class="grid">
                  <p class="grid-header">Editar link</p>
                  <div class="grid-body">
                     <?php $this->displayAlerts(); ?>
                     <div class="item-wrapper">
                        <div class="form-group">
                           <label for="inputEmail1">Título </label>
                           <input type="text" class="form-control" name="title" value="<?=$link['title']?>" placeholder="Enter file name">
                        </div>
                        <div class="form-group">
                           <label for="inputEmail1">Link Principal <sup>*</sup> </label>
                           <input type="url" class="form-control" value="<?=$link['main_link']?>" name="main_link" placeholder="Enter your main link">
                           <small>*Fontes Suportadas : <i>Direct Link, GDrive, GPhoto, OneDrive</i> </small>
                        </div>
                        <div class="form-group">
                           <label for="inputPassword1">Alternative Link</label>
                           <input type="url" class="form-control" value="<?=$link['alt_link']?>" name="alt_link" id="" placeholder="Enter alternative link">
                           <small>*Fontes Suportadas: <i>Direct Link, GDrive</i> </small>
                        </div>
                        <div id="subList">
                           <?php if(!empty($link['subtitles'])):
                              $subs = json_decode('[' . trim($link['subtitles']) . ']', true);
                              $subLables = json_decode(self::$config['sublist'], true);
                              if(empty($subLables)) $subLables = [];
                              foreach($subs as $k => $sub):
                              $fname = substr(str_replace(PROOT . '/uploads/subtitles/', '', $sub['file']), 0, 50) . '...';
                              
                              ?>
                           <div class="row ui-state-default "  data-id="<?=$k+1?>">
                              <div class="col-lg-4">
                                 <div class="mb-3">
                                    <select class="custom-select subLabel"  name="sub[<?=$k+1?>][label]">
                                    <?php 
                                       foreach($subLables as $slbl)
                                       {
                                         $selected = ($slbl == $sub['label']) ? 'selected' : '';
                                         echo '<option value="'.$slbl.'" '.$selected.'>'.ucwords($slbl).'</option>';
                                       }
                                       
                                       ?>
                                    </select>
                                    <a href="javascript:void(0)" class="text-danger removeSub">remove&nbsp;&nbsp;</a> 
                                    <a href="<?=$sub['file']?>" class="text-info">download</a>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                                 <div class="mb-3">
                                    <div class="input-group mb-2" style="justify-content: space-between;">
                                       <input type="file" class="subFile" name="sub[<?=$k+1?>][file]">
                                       <input type="text"  name="sub[<?=$k+1?>][file]" value="<?=$sub['file']?>" hidden>
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
                                    <span>
                                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke="none" d="M0 0h24v24H0z"></path>
                                          <path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9 l6.5 -6.5"></path>
                                       </svg>
                                       <span class="badge badge-dark"><?=$fname ?></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <?php endforeach;endif; ?>
                        </div>
                        <button type="button" class="add-sub btn btn-xs btn-outline-secondary">Adicionar legenda</button>
                        <p class="mt-3"><small>Ultima atualização : <?=$link['updated_at']?></small></p>
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
                           <input type="text" name="preview_img" value="<?=$link['preview_img']?>" hidden >
                           <?php if(!empty($link['preview_img'])): ?>
                           <img src="<?=PROOT?>/uploads/images/<?=$link['preview_img']?>" class="mt-1 w-100" > 
                           <a href="javascript:void(0)" class="remove_preview_img text-danger" >Remover</a>
                           <?php endif; ?>
                        </div>
                        <div class="form-group">
                           <label for="inputEmail1">Nome personalizado </label>
                           <input type="text" name="slug" value="<?=$link['slug']?>" class="form-control" id="inputEmail1" placeholder="Enter custom video slug">
                        </div>
                        <div class="form-group">
                           <label for="">Status do link</label>
                           <select name="status" class="custom-select">
                              <option value="0" <?php if($link['status'] == 0) echo 'selected'; ?> >Ativo</option>
                              <option value="1" <?php if($link['status'] == 1) echo 'selected'; ?> >Inativo</option>
                           </select>
                        </div>
                        <?php if($isDrive && !empty($link['data'])):
                                 $qt = Main::getQulities($link['data']);
                                 $qualities = implode(', ', $qt); ?>       
                        <div class="form-group">
                           <label for="inputEmail1">Available Qulities: </label>
                              <span class="badge badge-pill badge-inverse-dark"><?=$qualities?></span>
                        </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary btn-block mt-0">Salvar link</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
      <div class="row">

      <?php
       $st_vurl = 'Not supported !';
         if($link['type'] == 'GDrive')
         {
            $q = isset($qt) ? $qt[0] : 360;
            $st_vurl = Main::getStreamLink($link['slug'], $q);
         }
      ?>

      <div class="col-md-4 col-sm-6 equel-grid">
            <div class="grid deposit-balance-card">
               <div class="grid-body">
                  <p class="card-title">Stream direto Link</p>
                  <div class="form-group  mt-3 position-relative" >
                     <textarea class="form-control " id="streamLink" cols="12" rows="5" ><?=$st_vurl?></textarea>
                     <button type="button" class="btn btn-xs btn-success position-absolute" id="copyStreamLink" style="bottom: 8px;right:8px;">copy</button>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4 col-sm-6 equel-grid">
            <div class="grid deposit-balance-card">
               <div class="grid-body">
                  <p class="card-title">Player Link</p>
                  <div class="form-group  mt-3 position-relative" >
                     <textarea class="form-control" id="plyrLink" cols="12" rows="5" ><?=Main::getPlyrLink($link['slug'])?></textarea>
                     <button type="button" class="btn btn-xs btn-success position-absolute" id="copyPlyrLink" style="bottom: 8px;right:8px;">copy</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6 equel-grid">
            <div class="grid deposit-balance-card">
               <div class="grid-body">
                  <p class="card-title">Embed code</p>
                  <div class="form-group  mt-3 position-relative" >
                     <textarea class="form-control" id="embedCode" cols="12" rows="5" ><iframe src="<?=Main::getPlyrLink($link['slug'])?>" frameborder="0" allowFullScreen="true" width="640" height="320"></iframe></textarea>
                     <button type="button" class="btn btn-xs btn-success position-absolute" id="copyEmbedCode" style="bottom: 8px;right:8px;">copy</button>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-4 col-sm-6 equel-grid">
            <div class="grid deposit-balance-card">
               <div class="grid-body">
                  <p class="card-title">Download link</p>
                  <div class="form-group  mt-3 position-relative" >
                     <textarea class="form-control" id="downloadLink" cols="12" rows="5" ><?=Main::getDownloadLink($link['slug'])?></textarea>
                     <button type="button" class="btn btn-xs btn-success position-absolute" id="copyDownloadLink" style="bottom: 8px;right:8px;">copy</button>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>
<!-- content viewport ends -->
<div class="row ui-state-default  d-none" id="fiuop">
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