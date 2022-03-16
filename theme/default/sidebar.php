<div class="sidebar">
   <ul class="navigation-menu">
      <li class="nav-category-divider">PRINCIPAL</li>
      <li>
         <a href="<?=PROOT?>/dashboard">
         <span class="link-title">Dashboard</span>
         <i class="mdi mdi-gauge link-icon"></i>
         </a>
      </li>
      <li>
         <a href="#links" data-toggle="collapse" aria-expanded="false">
         <span class="link-title">Links</span>
         <i class="mdi mdi-link-variant link-icon"></i>
         </a>
         <ul class="collapse navigation-submenu" id="links">
            <li>
               <a href="<?=PROOT?>/links/new">Criar novo link</a>
            </li>
            <li>
               <a href="<?=PROOT?>/links/active">Links ativos </a>
            </li>
            <li>
               <a href="<?=PROOT?>/links/paused">Links pausados </a>
            </li>
            <li>
               <a href="<?=PROOT?>/links/broken">Links quebrados </a>
            </li>
         </ul>
      </li>
      <li>
         <a href="<?=PROOT?>/bulk">
         <span class="link-title">Importação em Massa</span>
         <i class="mdi mdi-import link-icon"></i>
         </a>
      </li>
      <li>
         <a href="<?=PROOT?>/ads">
         <span class="link-title">Publicidades</span>
         <i class="mdi mdi-currency-usd link-icon"></i>
         </a>
      </li>
      <li>
         <a href="#settings" data-toggle="collapse" aria-expanded="false">
         <span class="link-title">Configurações</span>
         <i class="mdi mdi-settings link-icon"></i>
         </a>
         <ul class="collapse navigation-submenu" id="settings">
            <li>
               <a href="<?=PROOT?>/settings/general">Geral</a>
            </li>
            <li>
               <a href="<?=PROOT?>/settings/proxy">Proxy</a>
            </li>
            <li>
               <a href="<?=PROOT?>/settings/gdrive-auth">GDrive Auth</a>
            </li>
            <li>
               <a href="<?=PROOT?>/settings/update">Update</a>
            </li>

         </ul>
      </li>
      <li class="nav-category-divider">Script</li>
      <li>
         <a href="#">
         <span class="link-title">Reportar bug</span>
         <i class="mdi mdi-bug link-icon"></i>
         </a>
      </li>
      <li>
         <a href="#">
         <span class="link-title">Documentação</span>
         <i class="mdi mdi mdi-file-document link-icon"></i>
         </a>
      </li>
   </ul>
   <div class="sidebar_footer">
      <div class="user-account">
         <a class="user-profile-item" href="<?=PROOT?>/profile"><i class="mdi mdi-account"></i> Perfil</a>
         <a class="btn btn-primary btn-logout" href="<?=PROOT?>/logout">Sair</a>
      </div>
      <div class="btn-group admin-access-level">
         <div class="avatar">
            <img class="profile-img" src="<?=PROOT?>/uploads/images/<?=$this->userImg?>" height="50" alt="">
         </div>
         <div class="user-type-wrapper">
            <p class="user_name"><?=$_SESSION['user']?></p>
            <div class="d-flex align-items-center">
               <div class="status-indicator small rounded-indicator bg-success"></div>
               <small class="user_access_level">Admin</small>
            </div>
         </div>
         <i class="arrow mdi mdi-chevron-right"></i>
      </div>
   </div>
</div>