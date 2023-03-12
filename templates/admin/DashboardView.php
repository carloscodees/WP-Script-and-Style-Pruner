<?php
// check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }

  //Get the active tab from the $_GET param
  $default_tab = null;
  $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;

  ?>
  <!-- Our admin page content should all be inside .wrap -->
  <div class="wrap about-wrap">
    <!-- Print the page title -->
    <button class="ui button">
  Follow
</button>
    <h1>Welcome to your script remover!</h1>
    <div class="about-text">
    Thank you for choosing us as your toolbox! A box where you can easily remove scripts and styles for your WordPress website!
    </div>
    <!-- Here are our tabs -->
    <nav class="nav-tab-wrapper">
      <?php
          foreach($this->generateMenu() as $index =>  $menu):
      ?>
         <a href="?page=template_plugin&tab=<?=$menu['tab']?>" class="nav-tab <?php if($tab===$menu['tab']):?>nav-tab-active<?php endif; ?>"><?=$menu['name']?></a>
      <?php
          endforeach;
      ?>
      <!-- <a href="?page=template_plugin" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">General</a>
      <a href="?page=template_plugin&tab=settings" class="nav-tab <?php if($tab==='settings'):?>nav-tab-active<?php endif; ?>">Global Scripts</a>
      <a href="?page=template_plugin&tab=tools" class="nav-tab <?php if($tab==='tools'):?>nav-tab-active<?php endif; ?>">Global Styles</a> -->
    </nav>

    <div class="tab-content">
    <?php
     foreach($this->generateMenu() as $index =>  $menu):
       if((is_array($menu['function']) && $menu['tab'] === $tab) &&  ($menu['function'][0] && $menu['function'][1]) ) call_user_func_array(array($menu['function'][0], $menu['function'][1] ), array());
     endforeach; 
    ?>
    </div>
  </div>