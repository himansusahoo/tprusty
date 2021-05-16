<div class="row-fluid">
    chosen:
    <select data-placeholder="Your Favorite Type of Bear" class="chosen-select">
        <option value=""></option>
        <option>American Black Bear</option>
        <option>Asiatic Black Bear</option>
        <option>Brown Bear</option>
        <option>Giant Panda</option>
        <option selected="">Sloth Bear</option>
        <option disabled="">Sun Bear</option>
        <option>Polar Bear</option>
        <option disabled="">Spectacled Bear</option>
    </select>
</div>
<script>
    $(document).ready(function () {
        $(".chosen-select").chosen({disable_search_threshold: 10});
    });
</script>