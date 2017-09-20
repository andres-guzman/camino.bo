<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$from = 'Camino Contact Form';
		$to = 'andres@camino.bo, andres.16602@gmail.com';
		$subject = 'Camino web message';

		$body ="Nombre: $name\n Email: $email\n\n Mensaje:\n $message";
		if (!$_POST['name']) {
			$errName = 'Por favor escribe tu nombre';
		}
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Por favor escribe un email válido';
		}
		if (!$_POST['message']) {
			$errMessage = 'Por favor escribe tu mensaje';
		}
		if ($human !== 5) {
			$errHuman = 'Por favor escribe la respuesta correcta';
		}

if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
    $class = "";
	if (mail ($to, $subject, $body, $headers)) {
		$result='<div class="submission-success">Mensaje enviado! Te responderé pronto.</div>';
        $class = 'class="is-hidden"';
	} else {
		$result='<div class="submission-error">Hubo un error al enviar su mensaje, por favor intenta denuevo:</div>';
		$class = 'class="red-border"';
		$classError = 'class = "is-hidden"';
	}
}
	}
?>
<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Camino — Contact</title>
        <meta name="description" content="Here is where you can get in touch with me for freelance opportunities.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/a.css">
        <link rel="icon" type="image/png" href="../../favicon.png">
        <link rel="apple-touch-icon" href="../../apple-touch-icon.png">        
    </head>
    <body>
        <a id="start"></a>
        <div id="main" class="m-scene">
            <div id="nav-language">
                <span class="is-visible">Language — </span> <a href="../../contacto/">Español</a> <span class="nav-language-sep">\</span> <span id="nav-language-active">English</span>
            </div>

            <header>                                
                <a href="../" id="logo">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 762.3 123.8" style="enable-background:new 0 0 762.3 123.8;" xml:space="preserve">
                        <path class="logo-text" d="M65.6,62.1c0-37,28-61.9,64.8-61.9c28.9,0,44.5,16.3,52.2,31.9l-26.6,12.7c-3.9-9.5-14.2-17.4-25.7-17.4 C110.8,27.5,97,42.4,97,62.1c0,19.6,13.8,34.6,33.4,34.6c11.5,0,21.7-7.9,25.7-17.4l26.6,12.6c-7.7,15.3-23.3,32.1-52.2,32.1 C93.6,124.1,65.6,98.9,65.6,62.1z" />
                        <path class="logo-text" d="M275.6,123.8l-6.1-17.8h-48.8l-6.1,17.8h-36.2L224.9,0h40.3l46.6,123.8H275.6z M245.1,31.6l-15.8,46.6h31.4L245.1,31.6z" />
                        <path class="logo-text" d="M428.5,123.8V42l-31.2,81.9h-14.1L351.8,42v81.9h-31.9V0h44.4l26,68.3L416,0h44.4v123.8H428.5z" />
                        <path class="logo-text" d="M469.5,123.8V0h31.9v123.8H469.5z" />
                        <path class="logo-text" d="M594.8,123.8l-52.4-71.7v71.7h-31.9V0h32.9l50.1,68.1V0h32.1v123.8H594.8z" />
                        <path class="logo-text" d="M634.3,61.9c0-36.4,27.5-61.9,64.1-61.9c36.6,0,63.9,25.5,63.9,61.9s-27.3,61.9-63.9,61.9 C661.8,123.8,634.3,98.3,634.3,61.9z M730.9,61.9c0-19.6-12.7-34.6-32.5-34.6c-19.7,0-32.7,15.1-32.7,34.6 c0,19.4,12.9,34.6,32.7,34.6C718.2,96.5,730.9,81.3,730.9,61.9z" />
                        <polygon class="logo-polygon" points="7.8,12 7.7,15.6 40.5,0.2 24.8,37.9 60.7,12.3 51,49.6 56.4,49.3 41.7,57.7 48.1,30.7 6,61 26.2,15.3 0,27.1 " />
                    </svg>
                </a>

                <div id="logo-caption">
                    Portfolio of Andres Guzman — Web designer and developer
                </div>

                <nav>
                    <ul>
                        <li><a href="../" title="projects">Projects</a></li>
                        <li><a href="../about/" title="about">About</a></li>
                        <li class="nav-active">Contact</li>
                        <li><a href="../blog/" title="Blog">Blog</a></li>
                    </ul>                   
                </nav>
            </header>            

			<div id="contact-flex">
				<main id="contact" class="scene_element scene_element--fadein">
					<h1>If you would like to get in touch with me for a possible work opportunity, or maybe just say hi, please write at:</h1>

					<div class="contact-card">
						<a href="mailto:andres@camino.bo">andres@camino.bo</a>
					</div>

					<?php echo $result; ?>

					<div id="form-card" <?php echo $class ?> >
                        <p <?php echo $classError ?>>Or you can fill in the contact form:</p>
                        <form id="formsubmit" action="./" method="post">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name:" required maxlength="80" value="<?php echo htmlspecialchars($_POST['name']); ?>" />
                                        <?php echo "<div class='text-danger'>$errName</div>";?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email:" required maxlength="80" value="<?php echo htmlspecialchars($_POST['email']); ?>" />
                                        <?php echo "<div class='text-danger'>$errEmail</div>";?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea class="form-control" rows="3" id="message" name="message" placeholder="Message:" required><?php echo htmlspecialchars($_POST['message']);?></textarea>
                                        <?php echo "<div class='text-danger'>$errMessage</div>";?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tdHuman">
                                        <label for="human" class="control-label">2 + 3 = ?</label>
                                    </td>
                                    <td class="tdControl">
                                        <input type="text" class="form-control" id="human" name="human" placeholder="Answer:" maxlength="2" required />
                                        <?php echo "<div class='text-danger'>$errHuman</div>";?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input id="submit" name="submit" type="submit" value="Submit" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>                
				</main>

				<footer>
					<div id="nav-social">
						<a href="https://www.behance.net/andresguzman">Behance</a> <a href="https://twitter.com/__oily">Twitter</a> <a href="https://www.instagram.com/okcancel/">Instagram</a>
					</div>

					<div id="copyright">© 2017 Andres Guzman.</div>
				</footer>
			</div>			
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
        <script src="../../js/main.js"></script>
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-106378338-1','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>
</html>