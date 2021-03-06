<script type="text/javascript" src="{{ asset('front/js/jquery.easing.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/infinite-scroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/contact.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/validator.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/morphext.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/custom.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    var placeholder = $('#location-search-bar option:nth-child(1)');
    console.log(placeholder.text());
    $('#location-search-bar').select2({
        width: '160px',
        placeholder: placeholder.text(),
        theme: "material"
    });

    $("#location-search-bar").on("select2:select", function(selected) {
        window.location.href = '/' +  selected.params.data.id;
    });
});
</script>
