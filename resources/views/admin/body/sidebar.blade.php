<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!-- User details -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a
                        href="javascript: void(0);"
                        class="has-arrow waves-effect"
                    >
                        <i class="ri-tools-fill"></i>
                        <span>Business Partners</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                        <a href="{{ route('supplier.all') }}"> Supplier </a>
                        <a href="{{ route('postalCodes.all') }}"> Postal Code </a>
                    </li>
                    </ul>
                </li>

                <li>
                    <a
                        href="javascript: void(0);"
                        class="has-arrow waves-effect"
                    >
                        <i class="ri-table-2"></i>
                        <span>Produção</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                           <!-- <a href="{{ route('families.all') }}"> Families </a>-->
                            <a href="{{ route('barcode.reader') }}">
                                Leitor de Código de Barras
                            </a>
                            <a href="{{ route('monitor.all') }}">
                                Monitorização
                            </a>
                            <a href="{{ route('product.all') }}"> Products </a>
                            <a href="{{ route('taxRates.all') }}"> TaxRates </a>
                            <a href="{{ route('unitMeasures.all') }}">
                                Units
                            </a>
                            <!--<a href="{{ route('parteleira.all') }}"> Parteleiras </a>-->
                        </li>
                    </ul>
                </li>

               <!-- <li>
                    <a
                        href="javascript: void(0);"
                        class="has-arrow waves-effect"
                    >
                        <i class="ri-file-text-line"></i>
                        <span>Documents</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"
                                >Entry Documents</a
                            >
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="">Opção 1</a></li>
                                <li><a href="">Opção 2</a></li>
                                <li><a href="">Opção 3</a></li>
                                <li><a href="">Opção 4</a></li>
                                <li><a href="">Opção 5</a></li>
                                <li><a href="">Opção 6</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a
                        href="javascript: void(0);"
                        class="has-arrow waves-effect"
                    >
                        <i class="ri-table-2"></i>
                        <span>Statistics</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="">Opção 1</a></li>
                    </ul>
                </li>-->

                <li class="menu-title">Infrastructure</li>

                <li>
                    <a
                        href="javascript: void(0);"
                        class="has-arrow waves-effect"
                    >
                        <i class="ri-account-circle-line"></i>
                        <span>ERP4U Ticket Line</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="????.html">Create a Ticket</a></li>
                        <li><a href="????.html">Messages</a></li>
                        <li><a href="????.html">Online Assistance</a></li>
                        <li><a href="????.html">Updates</a></li>
                    </ul>
                </li>

                <li>
                    <a
                        href="javascript: void(0);"
                        class="has-arrow waves-effect"
                    >
                        <i class="ri-profile-line"></i>
                        <span>Utility</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="???">Calculator</a></li>
                        <li><a href="???">Browser</a></li>
                        <li><a href="???">Alexa</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
