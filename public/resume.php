<?php
//Usage
require '../core/session.php';
//checkSession();

$meta=[];
$meta['title']='Chris\' Resume';

$content=<<<EOT

<body id="top">
	<div id="cv" class="instaFade">
		<div class="mainDetails">
			<div id="headshot" class="quickFade">
				<img src="https://www.gravatar.com/avatar/4678a33bf44c38e54a58745033b4d5c6?d=mm&s=64" alt="My Avatar">
			</div>

			<div id="name">
				<h1 class="quickFade delayTwo">Chris G</h1>
				<h2 class="quickFade delayThree">Full Stack Web and Hybrid Mobile Applications Developer</h2>
			</div>

			<div id="contactDetails" class="quickFade delayFour">
				<ul>
					<li>p: 01234567890</li>
					<li>e: <a href="mailto:CG@sample.com" target="_blank">CG@sample.com.com</a></li>
					<li>w: <a href="http://www.CG420.github.io">www.CG420.github.io</a></li>
					<li>sm: <a href="..." target="_blank" rel="noopener">LinkedIn</a> <a href="..." target="_blank"
							rel="noopener">Facebook</a> <a href="..." target="_blank" rel="noopener">Instagram</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>

		<div id="mainArea" class="quickFade delayFive">
			<section>
				<article>
					<div class="sectionTitle">
						<h1>Personal Profile</h1>
					</div>

					<div class="sectionContent">
						<p>Full stack web and hybrid mobile applications developer specializing in full stack JavaScript
							application
							and architectures. Experienced in all stages of the development life cycle, well versed in
							numerous
							programming languages.
					</div>
					<div class="ulWrap">
						<ul class="list">
							<li>Hands-on experience leading all stages of system development efforts, including
								requirements in
								definition, design, architecture, testing, and support.</li>
							<li>Outstanding leadership abilities; able to coordinate and direct all phases of
								project-based efforts.
							</li>
						</ul>
					</div>
					<div class="section">
						<div class="sectionTitle">
							<h2>Core Competencies</h2>
						</div>
						<div class="ulWrap">
							<ul class="list">
								<li>Saavy Problem Solver</li>
								<li>Strong Analytical Skills</li>
								<li>Prioritizes Tasks</li>
							</ul>
							<ul class="list">
								<li>Hybrid Mobile Development</li>
								<li>Full Stack Development</li>
								<li>Strong Leadership Skills</li>
							</ul>
						</div>
					</div>
				</article>
				<div class="clear"></div>
			</section>


			<section>
				<div class="sectionTitle">
					<h1>Professional Experience</h1>
				</div>

				<div class="sectionContent">
					<article>
						<h3>zEyeland Inc. - Chicago, IL</h3>
						<p class="subDetails">April 2015 - Present</p>
						<p>zEyeland constructs mobile camera robotics that are controlled remotely using complex
							mathimatical
							programming.</p>
					</article>

					<article>
						<h3>Bob's Custom Websites - Chicago, IL</h3>
						<p class="subDetails">Janruary 2013 - March 2015</p>
						<p>Bob's Custom Websites builds custom web applications for clients acroos a large number of
							industries.</p>
					</article>

					<article>
						<h3>Web Developer</h3>
						<p class="subDetails">October 2006 - December 2012</p>
						<p>
							<ul>
								<li>Works with ES6, Node JS, HTML, JavaScript, CSS, MySQL, and MongoDB to build
									customized web
									applications for a diverse set of customers.</li>
								<li>Designed the application to meet the users' requirements document.</li>
								<li>Ensured corporate and department objectives were accomplished in accordance with
									outlined objectives
									and mission statements.</li>
							</ul>
							<h4>Key Contributions:</h4>
							<ul>
								<li>Developed and implemented procedures and guidelines, optimizing productivity and
									efficiency;
									generating significant cost savings.
								</li>
							<li>Recognized for the development of excellent business relationships, providing exemplary customer service.</li>
						</ul>
					</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Certifications / Technical Proficiencies</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="Certifications/Technical Proficiences">
					<li>
						<em>Certifications : </em>
						Agile Certified Scrum Master
					</li>
					<li>
						<em>Platforms : </em>
						Linux, Windows, Mac, LAMP, MEAN, NodeJS
					</li>
					<li>
						<em>Database : </em>
						MySQL, MongoDB
					</li>
					<li>
						<em>Tools : </em>
						VS Code, SSH, Gulp, Git
					</li>
					<li>
						<em>Languages : </em>
						HTML, CSS, SASS, JavaScript, ES6, PHP, Bash, SQL
					</li>
				</ul>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Education</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<h2>DeVry University - Chicago, IL</h2>
					<p class="subDetails">Bachelor of Science in Computer Information Systems</p>
					<p></p>
				</article>
				
				<article>
					<h2>MicroTrain Technologies - Chicago, IL</h2>
					<p class="subDetails">Agile Full Stack Web and Hybrid Mobile Application Development</p>
					<p></p>
				</article>
			</div>
			<div class="clear"></div>
		</section>
		
	</div>
</div>

EOT;

require '../core/layout.php';