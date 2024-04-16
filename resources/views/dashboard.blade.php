<x-app-layout>
    @section('title', 'Home')
    <x-success-message />
    <div class="container py-10">
        <x-partials.search />
        <x-blog.blog-layout>
            <figure>
                <img src="" alt="image">
                <p class="text-center">title</p>
            </figure>
            <div>
                <p class="line-clamp-4">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est magni quis voluptates laudantium? Dolorum excepturi, explicabo tenetur facilis omnis voluptates, numquam dolorem nobis blanditiis maxime quas aperiam earum? Accusantium, tempora.
                    Facere quas assumenda ipsum modi libero nam. Aspernatur esse dignissimos excepturi rem accusantium placeat, id enim vel nisi ab sunt similique magni cumque atque numquam amet nobis nostrum laborum architecto!
                    Assumenda dolorem modi nam magni quibusdam explicabo sequi ex magnam pariatur facere saepe consequatur ducimus labore, autem repudiandae adipisci earum, molestiae voluptatibus fuga recusandae sunt tenetur, quam tempora. Quos, mollitia!
                    Magni nemo officiis id doloremque quos tenetur atque exercitationem, suscipit error harum necessitatibus explicabo dolorum ipsa repudiandae dolore perspiciatis placeat cum! Voluptatem perferendis, quibusdam repellat modi odit vitae adipisci eos?
                    Harum earum consequuntur nisi accusamus eaque unde inventore cum dolorem illo, perferendis tempora, voluptatibus in. Rerum laboriosam illum qui repellendus a ducimus ut, hic minima dolor! Facilis ratione dicta laboriosam.
                </p>
            </div>
        </x-blog.blog-layout>
    </div>
</x-app-layout>