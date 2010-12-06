<?php
/** 
 * _leftmenu.php
 * Description	: The left menu of the Admin section
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
?>
              		<div id="sidebar">
                            <ul class="nav"> 
                                <li><a class="headitem item1" href="<?php echo base_url()?>dashboard">Dashboard</a>
                                    <ul <?php if($dashboard)echo "class=\"opened\""; ?> >
                                    <li><a href="<?php echo base_url()?>dashboard">Go back to dashboard</a></li>
                                    <li class="current"><a href="<?php echo base_url()?>whchain">Chains</a></li>
                                    <li><a href="#">Stores</a></li>
                                    <li><a href="#">Phase 2</a></li>
                                    <li><a href="#">Phase 3</a></li>
                                    </ul>
                                </li>
                                <li><a class="headitem item2" href="#">Settings</a>
                                    <ul>
                                    <li><a href="#">Your settings</a></li>
                                    <li><a href="#">Other Admins</a></li>
                                    </ul>                            
                                </li>
                                <li><a class="headitem item4" href="#">Edit</a>
                                    <ul>
                                    <li><a href="#">Edit Chains</a></li>
                                    <li><a href="#">Edit #####</a></li>
                                    <li><a href="#">Edit #####</a></li>
                                    <li><a href="#">Edit #####</a></li>
                                    </ul>
                                </li>
                            </ul><!--end subnav-->
                            
                          <div class="flexy_datepicker"></div>
                            
                        </div><!--end sidebar-->