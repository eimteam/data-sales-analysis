<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element"> <span>
                <img alt="image" class="img-circle" src="/img/profile_small.jpg" />
                 </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                 </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="contacts.html">Contacts</a></li>
                    <li><a href="mailbox.html">Mailbox</a></li>
                    <li class="divider"></li>
                    <li><a href="login.html">Logout</a></li>
                </ul>
            </div>
            <div class="logo-element">
                IN+
            </div>
        </li>
        <?php foreach($menu as $key=>$item){?>
        <li class="<?= $key==$parentmenu?'active':''; ?>">
            <a href="<?= $item['href'] ?>">
                <i class="<?= $item['icon'] ?>"></i> 
                <span class="nav-label"><?= $item['name'] ?></span> 
                <span class="<?= $item['right_icon'] ?>">
                    <?= $item['right_icon_value'] ?></span>
            </a>
            <?php if(isset($item['child'])&&count($item['child'])){ ?>
            <ul class="nav nav-second-level collapse">
                <?php foreach($item['child'] as $ckey=>$cmenu){ ?>
                <li class="<?= $ckey==$checkmenu?'active':''; ?>">
                    <a href="<?= $cmenu['href'] ?>"><?= $cmenu['name'] ?></a>
                </li>                
                <?php } ?>
            </ul>
            <?php } ?>
        </li>                
        <?php } ?>                   
    </ul>

</div>