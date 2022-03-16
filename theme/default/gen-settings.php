<div class="page-content-wrapper-inner">
   <div class="viewport-header">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb has-arrow">
            <li class="breadcrumb-item">
               <a href="<?=PROOT?>/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">Configurações</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Geral</li>
         </ol>
      </nav>
   </div>
   <div class="content-viewport">
      <div class="row">
         <div class="col-lg-7">
            <?php $this->displayAlerts(); ?>
            <div class="grid">
               <div class="item-wrapper">
                  <div class="tab-container">
                     <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data" >
                        <ul class="nav nav-pills "  id="bt-tab_5" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="bt-tab_5_1" data-toggle="tab" href="#bt-content_5_1" role="tab" aria-controls="bt-content_5_1" aria-selected="true">Principal</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="bt-tab_5_4" data-toggle="tab" href="#bt-content_5_4" role="tab" aria-controls="bt-content_5_4" aria-selected="false">Stream</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="bt-tab_5_2" data-toggle="tab" href="#bt-content_5_2" role="tab" aria-controls="bt-content_5_2" aria-selected="false">Player</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="bt-tab_5_3" data-toggle="tab" href="#bt-content_5_3" role="tab" aria-controls="bt-content_5_3" aria-selected="false">Download</a>
                           </li>
                        </ul>
                        <div class="tab-content" >
                           <div class="tab-pane show active" id="bt-content_5_1" role="tabpanel" aria-labelledby="bt-tab_5_1">
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Logo</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <input type="file" name="logo"  > 
                                    <input type="text" name="logo" id="logoVal" value="<?=self::$config['logo']?>" hidden>
                                    <?php if(!empty(self::$config['logo'])): ?>
                                    <br>  
                                    <img src="<?=PROOT?>/uploads/images/<?=self::$config['logo']?>" id="logoImg" height="50" alt="logo-img">
                                    <br>
                                    <a href="javascript:void(0)" class="text-danger" id="removeLogo" >Remover</a>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Favicon</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <input type="file" name="favicon"  > 
                                    <input type="text" name="favicon" id="favVal" value="<?=self::$config['favicon']?>" hidden>
                                    <?php if(!empty(self::$config['favicon'])): ?>
                                    <br>  
                                    <img src="<?=PROOT?>/uploads/images/<?=self::$config['favicon']?>" id="favIco" height="16" alt="favicon-img">
                                    <br>
                                    <a href="javascript:void(0)" class="text-danger" id="removeFav" >Remover</a>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Idiomas das legendas</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <textarea name="sublist" class="form-control" rows="5" cols="80"><?php
                                       $sublist ='';
                                           if (!empty(trim(self::$config['sublist']))) {
                                             $sublist = implode(', ', json_decode(self::$config['sublist'], true));
                                           }
                                       
                                        ?><?=$sublist?></textarea>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Tema escuro</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" name="dark_theme" class="custom-control-input" id="darkTheme" <?php if(self::$config['dark_theme'] == 1) echo 'checked="checked"'; ?> > 
                                       <label class="custom-control-label" for="darkTheme"></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Fuso horário</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <select class="custom-select" name="timezone" >
                                    <?php $tzlist = Main::getTimeZoneList();
                                       foreach ($tzlist as $tz) {
                                           $selected = (self::$config['timezone'] == $tz ) ? 'selected' : '';
                                           echo "<option value='{$tz}' {$selected}>{$tz}</option>";
                                       }
                                           ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="bt-content_5_2" role="tabpanel" aria-labelledby="bt-tab_5_2">

                           <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="autoEmbed">Auto Embed</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" name="autoEmbed" class="custom-control-input" id="autoEmbed" <?php if(self::$config['autoEmbed'] == 1) echo 'checked="checked"'; ?> > 
                                       <label class="custom-control-label" for="autoEmbed"></label>
                                    </div>
                                    <small>*Incorporar vídeo por DRIVE ID -> mydomain.com/v/DRIVE_ID</small>
                                 </div>

                              </div>

                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail10">Proteção de hot link</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" name="firewall" id="hotLink" <?php if(self::$config['firewall'] == 1) echo 'checked="checked"'; ?> > 
                                       <label class="custom-control-label" for="hotLink"></label>
                                    </div>
                                    <textarea class="form-control mt-2" name="allowed_domains"  rows="5" ><?php
                                       $ad ='';
                                         if (!empty(trim(self::$config['allowed_domains']))) {
                                           $ad = implode(', ', json_decode(self::$config['allowed_domains'], true));
                                         }
                                       
                                       ?><?=$ad?></textarea>
                                    <small>*Cada domínio separado por vírgula ( , ) ; <br> domain.com, domain2.com</small>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Player</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <select name="player" class="custom-select">
                                       <option value="jw" <?php if(self::$config['player'] == 'jw') echo 'selected="selected"'; ?> >JW Player</option>
                                       <option value="plyr" <?php if(self::$config['player'] == 'plyr') echo 'selected="selected"'; ?> >Plyr.io</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Slug</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <input type="text" class="form-control" name="playerSlug" value="<?=self::$config['playerSlug']?>" >
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Vídeo padrão </label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <input type="url" class="form-control" name="defaultVideo" value="<?=self::$config['defaultVideo']?>" placeholder="">
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="bt-content_5_3" role="tabpanel" aria-labelledby="bt-tab_5_3">
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Download: </label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="download" name="isDownload"  <?php if(self::$config['isDownload'] == 1) echo 'checked="checked"'; ?>        > 
                                       <label class="custom-control-label" for="download"></label>
                                    </div>
                                    <small>*Não sou recomendado habilitado o recurso de download, ele pode usar muitos recursos do servidor!</small>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Página de download: </label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="downloadPage" name="isDownloadPage" <?php if(self::$config['isDownloadPage'] == 1) echo 'checked="checked"'; ?> > 
                                       <label class="custom-control-label" for="downloadPage"></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Slug</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <input type="text" class="form-control" name="downloadSlug" value="<?=self::$config['downloadSlug']?>"  placeholder="">
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Nome do arquivo baixado (prefix)</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <input type="text" class="form-control"  name="downloadPrefix" value="<?=self::$config['downloadPrefix']?>">
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="inputEmail5">Contador regressivo</label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="input-group mb-3">
                                       <input type="number" class="form-control" name="countdown" value="<?=self::$config['countdown']?>" >
                                       <div class="input-group-append">
                                          <span class="input-group-text" > <small>secounds</small> </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row showcase_row_area">
                                 <label for="inputEmail5">Conteúdo da página</label>
                                 <textarea name="downloadPageContent" id="summernoteExample"><?=Main::unsanitized(self::$config['downloadPageContent'])?></textarea>
                              </div>
                           </div>

                           <div class="tab-pane" id="bt-content_5_4" role="tabpanel" aria-labelledby="bt-tab_5_4">
                              <div class="form-group row showcase_row_area">
                                 <div class="col-md-3 showcase_text_area">
                                    <label for="streamLink">Stream direto: </label>
                                 </div>
                                 <div class="col-md-9 showcase_content_area">
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="streamLink" name="streamLink"  <?php if(self::$config['streamLink'] == 1) echo 'checked="checked"'; ?>        > 
                                       <label class="custom-control-label" for="streamLink"></label>
                                    </div>
                                    <small>*Ativar / desativar link de stream direto</small>
                                 </div>
                              </div>
                             
                           </div>



                        </div>
                  </div>
               </div>
               <div class="text-right">
               <button class="btn btn-primary m-3">Salvar alterações</button>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- content viewport ends -->