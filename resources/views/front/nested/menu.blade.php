<ul class="vertical-menu scrollspy">
    <li class="search-location">
        <i class="search-bar fas fa-search"></i>
        <select class="select2-simple js-states form-control" id="location-search-bar">
            <option value="">Buscar</option>
            @foreach($form->menu->getList() as $location)
            <option value="{{ $location['id'] }}">{{ $location['label'] }}</option>
            @endforeach
        </select>
    </li>
    <li class="active"><a href="#home"><i class="fas fa-asterisk"></i>Fica Em Casa</a></li>
<!--    <li><a href="#map-world"><i class="fas fa-globe"></i>World Map</a></li>
    <li><a href="#map"><i class="fas fa-globe-americas"></i>Map of Brazil</a></li>
-->    <li><a href="#about"><i class="fas fa-superscript"></i>Números</a></li>
        <li><a href="#charts"><i class="fas fa-chart-bar"></i>Gráficos</a></li>
<!--    <li><a href="#services"><i class="fas fa-chart-bar"></i>Analytics</a></li>

    <li><a href="#experience"><i class="fas fa-history"></i>History</a></li>
    <li><a href="#works"><i class="fas fa-question-circle"></i>Information</a></li>
    <li><a href="#blog"><i class="fas fa-link"></i>Links</a></li>
    <li><a href="#contact"><i class="fas fa-feather-alt"></i>Contact us</a></li>-->
</ul>

