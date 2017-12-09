{% extends "master.volt" %}
{% block content %}
    <h1>Congratulations!</h1>

    <p>You're now flying with Phalcon. The qrcode is youzan pay qrcode.</p>

    <p><img src="{{ qrcode }}" alt=""></p>
{% endblock %}