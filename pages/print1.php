<?php
include '../include/config_new.php';
include '../include/MysqliDb.php';
include '../include/config.php';
$a= new crud();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
     <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/jameelkhushkhati-ttf" type="text/css"/>
    <!--  <link rel="stylesheet" href="../css/print.css" /> -->

    <meta name="author" content="">

    <title>Doctor | Prescription</title>

   <?php
 include 'lib.php'; 
  include '../include/auth.php';
 ?>
</head>
<style>
  /* Styles go here */

.page-header, .page-header-space {
  height: 100px;
}

.page-footer, .page-footer-space {
  height: 50px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 1px solid black; /* for demo */
  background: yellow; /* for demo */
}

.page-header {
  position: fixed;
  top: 0mm;
  width: 100%;
  border-bottom: 1px solid black; /* for demo */
  background: rgb(111, 235, 111); /* for demo */
}

.page {
  page-break-after: always;
}

@page {
   margin: 3mm 0mm 0mm 0mm;
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
}
</style>
<body>
  <div class="container-fluid" style="overflow-x:hidden;">
    <div id="wrapper">
<?php include 'sidebardoc.php'; ?>
     <div id="page-wrapper" style="">
               <div class="container" style="width: 100%;">
  <!--<div class="page-header" style="text-align: center">-->
  <!--  I'm The Header-->
  <!--  <br/>-->
  <!--  <button type="button" onClick="window.print()" style="background: pink">-->
  <!--    PRINT ME!-->
  <!--  </button>-->
  <!--</div>-->

  <!--<div class="page-footer">-->
  <!--  I'm The Footer-->
  <!--</div>-->

  <table>

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space">
              <div class="text-center set-logo-abv">
                        <img class="set-logo" src="../img/1602 x 360 px.jpg">
               </div>
          </div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <!--*** CONTENT GOES HERE ***-->
          
          <div class="page" style="line-height: 3;">
            PAGE 3 - Long Content
            <br/> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt metus eu consectetur rutrum. Praesent tempor facilisis dapibus. Aliquam cursus diam ac vehicula pulvinar. Integer lacinia non odio et condimentum. Aenean faucibus cursus
            mi, sed interdum turpis sagittis a. Quisque quis pellentesque mi. Ut erat eros, posuere sed scelerisque ut, pharetra vitae tellus. Suspendisse ligula sapien, laoreet ac hendrerit sit amet, viverra vel mi. Pellentesque faucibus nisl et dolor
            pharetra, vel mattis massa venenatis. Integer congue condimentum nisi, sed tincidunt velit tincidunt non. Nulla sagittis sed lorem pretium aliquam. Praesent consectetur volutpat nibh, quis pulvinar est volutpat id. Cras maximus odio posuere
            suscipit venenatis. Donec rhoncus scelerisque metus, in tempus erat rhoncus sed. Morbi massa sapien, porttitor id urna vel, volutpat blandit velit. Cras sit amet sem eros. Quisque commodo facilisis tristique. Proin pellentesque sodales rutrum.
            Vestibulum purus neque, congue vel dapibus in, venenatis ut felis. Donec et ligula enim. Sed sapien sapien, tincidunt vitae lectus quis, ultricies rhoncus mi. Nunc dapibus nulla tempus nunc interdum, sed facilisis ex pellentesque. Nunc vel
            lorem leo. Cras pharetra sodales metus. Cras lacus ex, consequat at consequat vel, laoreet ac dui. Curabitur aliquam, sapien quis congue feugiat, nisi nisl feugiat diam, sed vehicula velit nulla ac nisl. Aliquam quis nisi euismod massa blandit
            pharetra nec eget nunc. Etiam eros ante, auctor sit amet quam vel, fringilla faucibus leo. Morbi a pulvinar nulla. Praesent sed vulputate nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo
            mollis iaculis. Maecenas consectetur enim vitae mollis venenatis. Ut scelerisque pretium orci id laoreet. In sit amet pharetra diam. Vestibulum in molestie lorem. Nunc gravida, eros non consequat fermentum, ex orci vestibulum orci, non accumsan
            sem velit ac lectus. Vivamus malesuada lacus nec velit dignissim, ac fermentum nulla pretium. Aenean mi nisi, convallis sed tempor in, porttitor eu libero. Praesent et molestie ante. Duis suscipit vitae purus sit amet aliquam. Vestibulum lectus
            justo, lobortis a purus a, dapibus efficitur metus. Suspendisse potenti. Duis dictum ex lorem. Suspendisse nec ligula consectetur magna hendrerit ullamcorper et eget mauris. Etiam vestibulum sodales diam, eget venenatis nunc luctus quis. Ut
            fermentum placerat neque nec elementum. Praesent orci erat, rhoncus vitae est eu, dictum molestie metus. Cras et fermentum elit. Aenean eget augue lacinia, varius ante in, ullamcorper dolor. Cras viverra purus non egestas consectetur. Nulla
            nec dolor ac lectus convallis aliquet sed a metus. Suspendisse eu imperdiet nunc, id pulvinar risus. Maecenas varius sagittis est, vel fermentum risus accumsan at. Vestibulum sollicitudin dui pharetra sapien volutpat, id convallis mi vestibulum.
            Phasellus commodo sit amet lorem quis imperdiet. Proin nec diam sed urna euismod ultricies at sed urna. Quisque ornare, nulla et vehicula ultrices, massa purus vehicula urna, ac sodales lacus leo vitae mi. Sed congue placerat justo at placerat.
            Aenean suscipit fringilla vehicula. Quisque iaculis orci vitae arcu commodo maximus. Maecenas nec nunc rutrum, cursus elit quis, porttitor sapien. Sed ac hendrerit ipsum, lacinia fringilla velit. Donec ultricies feugiat dictum.
          </div>
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space">
              <img class="set-foot" src="../img/1628 x 110.jpg" style="">
          </div>
        </td>
      </tr>
    </tfoot>

  </table>
   </div>
  </div>
 </div>
</div>
</body>
</html>
