<?php
    require_once '../includes/header.php';
?>

 
<main style="margin-bottom: 150px;">
            <section class="container mt-5">
                <div class="row justify-content-center"> <!-- Agregamos la clase justify-content-center para centrar -->
                    <div class="col-md-8"> <!-- Cambiamos el tamaño de la columna a col-md-8 para que los recuadros sean un poco más anchos -->
                        <h2 class="text-center mb-4">Preguntas Frecuentes</h2> <!-- Agregamos la clase text-center para centrar el título -->
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ¿Cómo puedo registrarme?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Para registrarte, ve a la página de Login, y al final del formulario escoge la opción <span class="texto">"Registrate aquí"</span> y completa el formulario con tus datos personales.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        ¿Cómo puedo cambiar mi contraseña?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Para cambiar tu contraseña, ve al apartado de Login, y haz clic en el hipervinculo la opción de cambio de contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        ¿Cómo puedo contactar al soporte técnico?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Puedes contactar al soporte técnico enviando un correo electrónico a traves de nuestro formulario de contacto en el apartado de <span class="texto">"Contacto"</span> en la barra de navegación.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        ¿Cómo se resguardan mis datos?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Para asegurar el resguardo de sus datos se implentan certificados SSL y otras medidas de seguridad complejas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>


<?php
    require_once '../includes/footer.php';
?>