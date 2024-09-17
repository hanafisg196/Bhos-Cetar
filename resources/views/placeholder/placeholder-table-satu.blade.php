<style>
 @keyframes loading {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: 200px 0;
    }
}

.loading {
    position: relative;
}

.loading .bar {
    background-color: #E7E7E7;
    height: 14px;
    border-radius: 7px;
    width: 80%;
    overflow: hidden;
    position: relative;
}

.loading:after {
    position: absolute;
    transform: translateY(-50%);
    top: 50%;
    left: 0;
    content: "";
    display: block;
    width: 100%;
    height: 24px;
    background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
    background-size: 300px 24px;
    background-position: -200px 0;
    background-repeat: no-repeat;
    animation: loading 1.5s infinite ease-in-out;
}

</style>
<td class="loading">
    <div class="bar"></div>
</td>
<td class="loading">
    <div class="bar"></div>
</td>

<td class="loading">
    <div class="bar"></div>
  </td>
