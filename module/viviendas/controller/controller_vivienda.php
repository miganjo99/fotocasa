<?php
    // $data = 'hola crtl user';
    // die('<script>console.log('.json_encode( $data ) .');</script>');
    $path = $_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/'; 
    include ($path."module/viviendas/model/DAOVivienda.php");
    //session_start();
    
    switch($_GET['op']){
        case 'list';
             //$data = 'hola crtl list vivienda';
             //die('<script>console.log('.json_encode( $data ) .');</script>');
              
            try{
                $daovivienda = new DAOVivienda();
            	$rdo = $daovivienda->select_all_vivienda();
                // die('<script>console.log('.json_encode( $rdo->num_rows ) .');</script>');
             }catch (Exception $e){
                $callback = 'index.php?page=503';
			     //die('<script>window.location.href="'.$callback .'";</script>');
             }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
			    //die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
                include("module/viviendas/view/list_vivienda.php");
    		}
        break;
         
        case 'read_modal';
             //echo $_GET["id"]; 
             //exit;
            try{
                $dao_vivienda = new DAOVivienda();
                $rdo = $dao_vivienda -> select_id($_GET['id']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
                echo json_encode("error");
                exit;
            }else{
                $vivienda = get_object_vars($rdo);
                echo json_encode($vivienda);
                exit;
            }
        break;
        



        case 'create';
              //$data = 'hola crtl vivienda create';
              //die('<script>console.log('.json_encode( $data ) .');</script>');

             include("module/viviendas/model/validate.php");
            
             $check = true;
            
             if ($_POST){
                  
                //$data = 'hola create post VIVIENDAAAAAAAAAAAAAAAfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
                //die('<script>console.log('.json_encode( $data ) .');</script>');
                //die('<script>console.log('.json_encode( $_POST ) .');</script>');
                
                $check=validate();
                //die('<script>console.log('.json_encode( $check ) .');</script>');

                 if ($check){
                     // die('<script>console.log('.json_encode( $_POST ) .');</script>');
                     try{
                        $daovivienda = new DAOVivienda();
    	 	            $rdo = $daovivienda->insert_vivienda($_POST);
                         // die('<script>console.log('.json_encode( $rdo ) .');</script>');
                     }catch (Exception $e){
                         $callback = 'index.php?page=503';
         			    die('<script>window.location.href="'.$callback .'";</script>');
                     }
                    
		             if($rdo){
                         echo '<script language="javascript">setTimeout(() => {
                             toastr.success("Creado en la base de datos correctamente");
                         }, 1000);</script>';
                         echo '<script language="javascript">setTimeout(() => {
                             window.location.href="index.php?page=controller_vivienda&op=list";
                         }, 2000);</script>';
             		}else{
             			$callback = 'index.php?page=503';
    	 		        die('<script>window.location.href="'.$callback .'";</script>');
             		}
                 }
             }
             include("module/viviendas/view/create_vivienda.php");
             break;
            
        case 'update';
            include("module/viviendas/model/validate.php");
            $check = true;
            
                // die('<script>console.log('.json_encode( $data ) .');</script>');


            if ($_POST){
                 //$data = 'hola update post user';
                // die('<script>console.log('.json_encode( $data ) .');</script>');
                //$check=validate_js();
                //die('<script>console.log('.json_encode( $check ) .');</script>');
                
                if ($check){
                    //die('<script>console.log('.json_encode( $_POST ) .');</script>');
                    try{
                        $daovivienda = new DAOVivienda();
    		            $rdo = $daovivienda->update_vivienda($_POST);
                        //die('<script>console.log('.json_encode( $rdo ) .');</script>');
                    }catch (Exception $e){
                        $callback = 'index.php?page=503';
        			    die('<script>window.location.href="'.$callback .'";</script>');
                    }
                    
		            if($rdo){
            			echo '<script language="javascript">setTimeout(() => {
                            toastr.success("Modificado en la base de datos correctamente");
                        }, 1000);</script>';
                        echo '<script language="javascript">setTimeout(() => {
                            window.location.href="index.php?page=controller_vivienda&op=list";
                        }, 2000);</script>';
            		}else{
            			$callback = 'index.php?page=503';
    			        die('<script>window.location.href="'.$callback .'";</script>');
            		}
                }else{
                    echo '<script language="javascript">setTimeout(() => {
                        window.location.href="index.php?page=controller_vivienda&op=list";
                    }, 2000);</script>';
                }
            }
            
            try{
                $daovivienda = new DAOVivienda();
            	$rdo = $daovivienda->select_id($_GET['id']);
            	$vivienda=get_object_vars($rdo);
                //die('<script>console.log('.json_encode( $rdo ) .');</script>');

            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
        	    include("module/viviendas/view/update_vivienda.php");
    		}
            break;
            
        // case 'read';
        //     // $data = 'hola read';
        //     // die('<script>console.log('.json_encode( $data ) .');</script>');
        //     // die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');

        //     try{
        //         $daovivienda = new DAOVivienda();
        //     	$rdo = $daovivienda->select_id($_GET['id']);
        //     	$vivienda=get_object_vars($rdo);
        //         //die('<script>console.log('.json_encode( $user ) .');</script>');
        //     }catch (Exception $e){
        //         $callback = 'index.php?page=503';
		// 	    die('<script>window.location.href="'.$callback .'";</script>');
        //     }
        //     if(!$rdo){
    	// 		$callback = 'index.php?page=503';
    	// 		die('<script>window.location.href="'.$callback .'";</script>');
    	// 	}else{
        //         include("module/viviendas/view/read_vivienda.php");
    	// 	}
        //     break;
            
        case 'delete';

            //$data = 'hola delete';
            //die('<script>console.log('.json_encode( $POST ) .');</script>');
            //die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');

            if ($_POST){
                //$POST = 'hola post delete';
                //die('<script>console.log('.json_encode( $POST ) .');</script>');
                //die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');
                try{
                    $daovivienda = new DAOVivienda();
                	$rdo = $daovivienda->delete_vivienda($_GET['id']);
                }catch (Exception $e){
                    $callback = 'index.php?page=503';
    			    die('<script>window.location.href="'.$callback .'";</script>');
                }
            	if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.success("Borrado en la base de datos correctamente");
                    }, 1000);</script>';
                    echo '<script language="javascript">setTimeout(() => {
                        window.location.href="index.php?page=controller_vivienda&op=list";
                    }, 2000);</script>';
        		}else{
        			$callback = 'index.php?page=503';
			        die('<script>window.location.href="'.$callback .'";</script>');
        		}
            } 
           include("module/viviendas/view/delete_vivienda.php");

        break;

        case 'delete_all';
             //$data = 'hola delete_all';
             if ($_POST){
               //die('<script>console.log('.json_encode( $_POST ) .');</script>');
               try{
                   $dao_vivienda = new DAOVivienda();
                   $rdo = $dao_vivienda -> delete_all_vivienda();
                //die('<script>console.log('.json_encode( $rdo ) .');</script>');

               }catch (Exception $e){
                   $callback = 'index.php?page=controller_vivienda&op=503';
                   die('<script>window.location.href="'.$callback .'";</script>');
               }
               
               if($rdo){
                   echo '<script language="javascript">setTimeout(() => {
                       toastr.success("Lista de viviendas borrada correctamente");
                   }, 1000);</script>';
                   $callback = 'index.php?page=controller_vivienda&op=list';
                   die('<script>window.location.href="'.$callback .'";</script>');
               }else{
                   $callback = 'index.php?page=controller_vivienda&op=503';
                   die('<script>window.location.href="'.$callback .'";</script>');
               }
           }
           
           include("module/viviendas/view/delete_all_vivienda.php");
        break;


        case 'dummies';
            //$data = 'hola dummies';
            //die('<script>console.log('.json_encode( $_POST ) .');</script>');

            if ($_POST){
                try{
                    $dao_vivienda = new DAOVivienda();
                    $rdo = $dao_vivienda -> dummies_vivienda();
                }catch (Exception $e){
                    $callback = 'index.php?page=controller_vivienda&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }

                if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.success("Dummies creados correctamente");
                    }, 1000);</script>';
                    $callback = 'index.php?page=controller_vivienda&op=list';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }else{
                    $callback = 'index.php?page=controller_vivienda&op=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
            }
        
        include("module/viviendas/view/dummies_vivienda.php");
        break;
        
        default;
            include("view/inc/error404.php");
        break;
    }