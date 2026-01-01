<h1 style="text-align:center">{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }}</h1>
<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body text-center">
                {!! $about->parsed_text !!}
            </div>
        </div>
    </div>
</div>


    
<div class="row align-items-stretch">
    <div class="col-md-7 d-flex">
        <div class= "card flex-fill">
            @include('widgets._news', ['textPreview' => true])
        </div>
    </div>
    <div class="col-md-5 d-flex">
        @include('widgets._carousel')
    </div>
</div>
<br>

<div class="row mb-4 align-items-stretch">
    <div class="col-md-6 d-flex">
        <div class= "card py-4 px-2 flex-fill" style="text-align: center">
        <h5>Current Quest/event</h5>
            <div class="row mt-auto mb-auto">
            <div class="col-md-10 pt-2 pb-2 m-auto">
                
                    {!! $sidebar->box2content !!}
                
            </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class= "card pr-1 pl-1 flex-fill" style="text-align: center">
            <div class="row mt-auto mb-auto">
                <div class="col-md-4 ml-2 pt-2 pb-2">
                    <img src = "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b270d26f-24db-4b18-9f7b-ca5435d8ccdb/d9wg24f-48addbbf-6d97-4b26-827e-9b970c51863d.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2IyNzBkMjZmLTI0ZGItNGIxOC05ZjdiLWNhNTQzNWQ4Y2NkYlwvZDl3ZzI0Zi00OGFkZGJiZi02ZDk3LTRiMjYtODI3ZS05Yjk3MGM1MTg2M2QucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.HGSEEiH_l5I2_c95WGI-7C8JfI2haP9PxRShb_n0qqk">
                </div>
                <div class="col-md-7 pt-2 pb-2">
                    <h5>Kiwi's Kukuri Facts</h5>
                    <div id="factDisplay"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row align-items-stretch">
    <div class="col-md-3 d-flex">
        <div class= "card flex-fill text-center">
        <h4>Activity Hub</h4>
        <i>Want to get some items? Use some items? Find new and exciting places or take some risks? Heres some places to go!</i>
            <br>
            <a href="{{ url('https://kukuri-arpg.w3spaces.com/activities/quests.html') }}">
                                Current Quest/Event
                            </a>
                            <hr>
                            <a href="{{ url('info/hunting') }}">
                                Hunting
                            </a>
                            <a href="{{ url('info/gathering') }}">
                                Gathering
                            </a>
                            <a href="{{ url('info/traveling') }}">
                                Traveling
                            </a>
                            <a  href="{{ url('info/excavating') }}">
                                Excavating
                            </a>
                            <hr>
                            <a  href="{{ url('info/letters') }}">
                                Activity Letters
                            </a>
                            <a href="{{ url('info/coliseum') }}">
                                Coliseum
                            </a>
                            <a href="https://kukuri-arpg.w3spaces.com/activities/traveling-merchant.html">
                                Traveling Merchant
                            </a>
                            <hr>
                            <a href="{{ url('crafting') }}">
                                Crafting
                            </a>
                            <a href="{{ url('https://kukuri-arpg.w3spaces.com/activities/breeding.html') }}">
                                Breeding
                            </a>
                            <br>
        </div>
    </div>
    <div class="col-md-3 d-flex">
        <div class= "card flex-fill text-center">
        <h4>Genetics</h4>
            <img src ="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b270d26f-24db-4b18-9f7b-ca5435d8ccdb/d9or9qu-14278989-1d00-4b2d-8ba4-e70ef54b57fe.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2IyNzBkMjZmLTI0ZGItNGIxOC05ZjdiLWNhNTQzNWQ4Y2NkYlwvZDlvcjlxdS0xNDI3ODk4OS0xZDAwLTRiMmQtOGJhNC1lNzBlZjU0YjU3ZmUucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.PIvBbzRRBwJnzvFmdEYYs78B2c06XailM5dm6ncWwFI" width=70% style="margin: auto">
            <i>Curious about what those strange genetic letters mean? Or maybe what those feathers look like? Here are some guides for you get started with!</i>
            <br><br>
            <a href="">Genetics and Mutations</a>
            <a href="">Physical Traits</a>
            <a href="">Design Guide</a>
            <br>
        </div>
    </div>
    <div class="col-md-3 d-flex">
        <div class= "card flex-fill text-center">
            <h4>Guides</h4>
            <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/b270d26f-24db-4b18-9f7b-ca5435d8ccdb/daa0601-2278ed10-8f1c-4dcd-873c-4b51b940ca76.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcL2IyNzBkMjZmLTI0ZGItNGIxOC05ZjdiLWNhNTQzNWQ4Y2NkYlwvZGFhMDYwMS0yMjc4ZWQxMC04ZjFjLTRkY2QtODczYy00YjUxYjk0MGNhNzYucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.bHtGzr6iaKHlajaV7SpJ7Xi8BskqqSkqMXM0uuFZLjk" width=70% style="margin: auto">
            <i>Confused about something? Maybe our background rules got you stumped... perhaps your stuck on some import editing... regardless, weve got a guide for it!</i>
            <br><br>
            <b>Guides coming soon!</b>
            <i>These guides are not the same as our older, established pages. These will be new guide dedicated to certain parts of the game such as import editing, design creation, art rules and more. 
                <br>
                you can still find all current guides on their respective pages (traveling guide on the traveling page for example)</i>
        </div>
    </div>
    <div class="col-md-3 d-flex">
        <div class= "card flex-fill text-center">
        <h4>Recourses</h4>
            <i>Looking for something else? You may find it here!</i>
            <br>
            <a href="https://www.kukuri-arpg.com/prompts/prompts?prompt_category_id=11">Error and Mistake reports</a>
            <a href="{{ url('reports') }}">Site Bug Reports</a>
            <hr>
            <a href="https://www.kukuri-arpg.com/adoption-center">Adoption Center</a>
            <a href="https://www.kukuri-arpg.com/world/pets">Familiars</a>
            <a href="https://www.kukuri-arpg.com/world/item-categories">Items</a>
        </div>
    </div>
</div>

<br>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"  style="text-align: center">Queues <i class="fas fa-book"></i></h5>
                    <div class="row">
                        <div class="col-md-4">
                           Want to see where you are in the queue? <b><a href="{{ url('queues') }}">Click here</a></b> to see our queue status and where you are!
                            <br><br>
                           Your entries will be highlighted in the list, and you can sort by prompt. If you dont see your entry, please check your drafts!

                        </div>
                        <div class="col-md-7">
                            <div style="text-align: center">
                                All queues have an expected wait time of <b>2 weeks</b>.
                                <br><br>
                                These times might be longer or shorter depending on admin IRL, 
                                group events, or other things that may delay our work. Please
                                remain patient with us if the queues go a little over 2 weeks!
                            </div>
                            
                        </div>
                    </div>
                    
                    
            </div>
        </div>
        <a href="{{ url('users') }}">@include('widgets._online_count')</a>
        @include('widgets._recent_gallery_submissions', ['gallerySubmissions' => $gallerySubmissions])


<script>
    (function newFact() {
        const facts = ['Did you know, all kukuri have beaks! Some show more than others, and on some kukuri you may not even see it! Most often a Kukuri\'s beak is covered in skin and fur.',
   'Kukuri can pass on a maximum of 8 markings, if they have more markings than this, one or more gene will be marked as non-inheritable. This is done with brackets. For example, [nBl] is non-inheritable blanket!',
   'Most Kukuri have an average nest size of 1-3 eggs, however rank, potions, and familiars can impact this number. Some nests can be as big as 5 eggs!',
   'Some eggs are lost, or abandoned by their parent kukuri... these eggs are findable in activities such as traveling, hunting, excavating or gathering. This is pretty rare however.',
   'If your kukuri is particularly experienced, reaching 2000, 3000, or even more FP; they will bring back an extra item in activities per additional 1,000 FP (Up to a max of 5 extra)',
   'Common kukuris are domesticated versions of prairies, they did not occur naturally',
   'The goddess, Death, does not like Cerberus, because before recieving Life\'s boon, he refused to rest in death. Because of this, his many rebirths caused the mutations he accumulated',
    'All the first 4 sub-species of kukuri were planned out from the start of the game.',
    'Prairies evolved from Aerial and Glider crossbreeds; the remaining aquatic blood in Gliders turned prairies into muscular land dwellers, but they kept some of the feathers from their Aerial ancestry.',
    'Kukuris are a matriarchal species, and as such females tend to be more aggressive and in more leadership roles than their male counterparts',
    'The goddess, Life, is the origin of some Kraken stories told by sailors and seafarers',
    'The very first Aquatic seen was in the very first event the group held, where it was zombified and infected with mushrooms',
    'While Kukuris are not capable of human speech, they can mimic random noises and some simple words. Some are better at this than others.',
    'All kukuris are technically omnivores, the diet in their information mostly concerns what their preference is.',
    'In the very early days of the game, due to an oversight, there was short horns and short ears. This was quickly fixed as the group began running.',
    'A female Kukuri is called a dove, and a male kukuri is called a rook. A young kukuri is a puppy, and a group of kukuris is a loaf!',
    'In the lore, Prairies were thought to be extinct amongst Aerials and Aquatics, but it turned out that Death had kept some of them hidden away until she felt it was right time to reveal them.',
    'The goddess, Life, values experiences, and she revels in giving difficult obstacles so you can either fail, learn and do better, or prove yourself that you could indeed overcome it. She\'s always excited to learn new things and take part in competitions. For her, the mysteries and new challenges of the future are most important.',
    'The goddess, Death, values comfort and stillness, in her realm the souls rest until they\'re ready to return anew. She enjoys listening to all the tales the souls tell, both happy and sad. She is acutely aware how finite life truly is, and how much can still be crammed into one lifespan. For her remembering those who came before is most important, as they lead to inspiration or warnings alike.',
    'Kukuri do not have toe pads as many animals do, instead their feet are covered in a thin layer of fur, very similarly to Rabbits or Red pandas!'
];
  const randomFact = Math.floor(Math.random() * facts.length);
  document.getElementById('factDisplay').innerHTML = facts[randomFact];
})();
</script>



