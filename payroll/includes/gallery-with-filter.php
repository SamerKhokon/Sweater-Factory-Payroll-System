
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/gallery.css" rel="stylesheet" type="text/css" />
    <link href="css/facebox.css" rel="stylesheet" type="text/css" />
    <link href="css/tabs.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script src="js/popup/jquery.facebox.js" type="text/javascript"></script>
    <script src="js/quick-sand/jquery.quicksand.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            setupGallery();
            setupLeftMenu();
			setSidebarHeight();

        });
    </script>

        <div class="grid_10">
            <div class="box round first">
                
                    <h2>Gallery</h2>
                    <div class="block">
                    <div class="gallery-sand">
                        <div class="filter-options">
                            <!-- Big Gallery Sorting: Start -->
                            <ul class="sorting">
                                <li><a href="#" data-type="all" class="active">Show All</a></li>
                                <li><a href="#" data-type="buildings">Buildings</a></li>
                                <li><a href="#" data-type="streets">Streets</a></li>
                                <li><a href="#" data-type="nature">Nature</a></li>
                                <li><a href="#" data-type="clothing">Clothing</a></li>
                            </ul>
                        </div>
                        <!-- Big Gallery Sorting: End -->
                        <!-- Small Gallery Content: Start -->
                        <div class="filter-results">
                            <ul class="gallery small">
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g001">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_01.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_01.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_01.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g002">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_02.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_02.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_02.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g003">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_03.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_03.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_03.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g004">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_04.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_04.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_04.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g005">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_05.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_05.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_05.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g006">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_06.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_06.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_06.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g007">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_07.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_07.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_07.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g008">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_08.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_08.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_08.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g009">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_09.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_09.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_09.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g010">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_10.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_10.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_10.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g0011">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_11.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_11.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_11.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g012">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_12.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_12.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_12.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g013">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_13.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_13.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_13.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g014">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_14.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_14.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_14.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g015">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_15.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_15.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_15.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g016">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_16.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_16.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_16.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g017">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_17.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_17.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_17.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g018">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_18.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_18.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_18.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g019">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_19.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_19.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_19.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g020">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_20.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_20.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_20.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g021">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_21.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_21.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_21.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="nature" data-id="g022">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_22.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_22.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_22.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g023">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_23.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_23.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_23.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="clothing" data-id="g024">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_24.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_24.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_24.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="clothing" data-id="g025">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_25.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_25.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_25.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="clothing" data-id="g026">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_26.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_26.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_26.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="clothing" data-id="g027">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_27.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_27.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_27.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g028">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_28.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_28.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_28.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="streets" data-id="g029">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_29.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_29.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_29.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                                <!-- Small Gallery Image: Start -->
                                <li data-type="buildings" data-id="g030">
                                    <div class="actions">
                                        <a href="#" class="delete">delete</a> <a href="#" class="edit">edit</a> <a href="img/gallery/image_30.jpg"
                                            class="view popup">view</a>
                                    </div>
                                    <a href="img/gallery/image_30.jpg" class="popup">
                                        <img src="img/gallery/thumbs_small/image_30.png" alt="" />
                                    </a></li>
                                <!-- Small Gallery Image: End -->
                            </ul>
                        </div>
                        <!-- Small Gallery Content: End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
   