
<style>
    :root{ --navbar-height: 10rem; }
    nav ~ main {margin-top: var(--navbar-height);}
</style>
<script src="https://code.jquery.com/jquery-1.12.0.js"></script>
<script src="..\rsc\imports\js\navjs.js"></script>
<nav class="fixed-top">

    <div id="customnav" class="navbar navbar-expand-sm">
        <img id="navimg" src="../rsc/img/navhome1.png">

        <a class="navbar-brand"><img src="../rsc/img/Kroalogo.png" alt="logo" style="width:40px;"></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link mainnav" id="homenav" href="#">Home</a>
            <li class="nav-item ">
                <a class="nav-link mainnav" id="eventnav" href="#">Events</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link mainnav" id="peoplenav" href="#">People</a>
            </li>
        </ul>
    </div>

    <div id="secondnav" class="navbar navbar-expand-sm" >

        <div class="subhide" id="homenavsub">
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link" href="#">Home</a>

        </div>

        <div class="subhide" id="eventnavsub">
            <a class="nav-link" href="#">Event</a>
            <a class="nav-link" href="#">Event</a>
            <a class="nav-link" href="#">Event</a>
            <a class="nav-link" href="#">Event</a>
        </div>

        <div class="subhide" id="peoplenavsub">
            <a class="nav-link" href="#">People</a>
            <a class="nav-link" href="#">People</a>
            <a class="nav-link" href="#">People</a>
            <a class="nav-link" href="#">People</a>
        </div>
    </div>
</nav>
