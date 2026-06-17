@extends('layouts.front-end.app')

@section('title', __('messages.about_us'))

@section('content')
    <div class="container for-container rtl">
        <h2 class="text-center py-4 fs-24 font-semi-bold text-capitalize">{{ __('messages.about_us') }}</h2>
        @if(app()->getLocale() == 'ar')
        <!DOCTYPE html>
        <html lang="ar">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>من نحن؟ - أبعاد العقارية</title>
        </head>
        <body>

            <h1>من نحن؟</h1>

            <p>في الماضي، كانت العقارات في المملكة العربية السعودية تُدار بشكل أساسي عبر وسائل تقليدية تعتمد على العلاقات الشخصية والمعرفة المحلية. كان الحصول على معلومات دقيقة حول العقارات المتاحة للبيع أو الإيجار أمرًا معقدًا، وغالبًا ما يتطلب الاتصال المباشر مع المالك أو الاعتماد على وسطاء محليين غير معتمدين. كانت هذه الطريقة غير منظمة وغير شفافة في كثير من الأحيان، مما جعل السوق غير مستقر وغير جذاب للمستثمرين.</p>

            <p>في هذه الفترة، كانت العقارات تُسوق من خلال الإعلانات الورقية والإشارات المباشرة على العقار نفسه، وكان التواصل بين الأطراف يعتمد بشكل رئيسي على الاجتماعات وجهاً لوجه، مما استغرق وقتًا طويلًا لإتمام الصفقات. كما أن التعاملات كانت تفتقر إلى الحماية القانونية الكافية، حيث لم تكن هناك آليات واضحة لحل النزاعات أو ضمان حقوق الأطراف.</p>

            <h2>تطور السوق العقاري من خلال الهيئة العامة للعقار</h2>

            <p>مع إنشاء <em>الهيئة العامة للعقار</em>، بدأ السوق العقاري في السعودية يشهد تحولًا كبيرًا نحو الاحترافية والتنظيم. ومن خلال وضع تشريعات وقوانين محددة، عملت الهيئة على تطوير بيئة عقارية أكثر شفافية وثباتًا، مما ساعد في تقليل التلاعب والنزاعات في السوق. كما قامت الهيئة بتقديم تراخيص للوسطاء العقاريين وفق معايير محددة، وتطوير برامج تدريبية لضمان تقديم الخدمات العقارية بطريقة احترافية تتماشى مع أفضل الممارسات العالمية.</p>

            <p>واستطاعت الهيئة أيضًا تحسين الشفافية في السوق من خلال توفير بيانات دقيقة ومحدثة حول السوق العقاري، بما في ذلك الأسعار والعرض والطلب، مما ساعد على بناء ثقة أكبر بين المشترين والبائعين. هذه الخطوات ساهمت في زيادة استقطاب الاستثمارات المحلية والدولية إلى السوق السعودي، ودعمت النمو العقاري المستدام بما يتوافق مع رؤية المملكة 2030.</p>

            <h2>نبذة موسعة عن منصة أبعاد العقارية</h2>

            <p>منصة <em>أبعاد العقارية</em> تمثل نقلة نوعية في كيفية عرض وتسويق العقارات في المملكة. تعد المنصة حلاً شاملاً يلبي احتياجات جميع المستخدمين، سواء كانوا باحثين عن شراء عقار، تأجير، أو حتى الاستثمار. باستخدام التكنولوجيا المتقدمة، تتيح المنصة تجربة شاملة تمكن المستخدمين من استكشاف العقارات وتقييمها دون الحاجة لزيارتها فعليًا، مما يوفر الوقت والجهد.</p>

            <h3>الميزات المميزة في منصة أبعاد العقارية</h3>

            <ul>
                <li><strong>الصور بدقة وجودة عالية:</strong> توفر المنصة صورًا عالية الجودة لجميع العقارات المعروضة، مما يسمح للمستخدمين بمعاينة التفاصيل الدقيقة بشكل واضح.</li>
                <li><strong>المخططات التفصيلية:</strong> يقدم الموقع مخططات هندسية شاملة للعقارات، مما يساعد المستخدمين في تصور التصميم الداخلي وتوزيع المساحات بشكل دقيق.</li>
                <li><strong>الفيديوهات التوضيحية:</strong> يمكن لكل عقار أن يحتوي على مقاطع فيديو توضيحية تعرض التفاصيل الداخلية والخارجية للعقار، مما يمنح المستخدمين صورة واقعية وحيوية.</li>
                <li><strong>الجولات الافتراضية بزاوية 360 درجة:</strong> تتيح للمستخدمين القيام بجولات افتراضية داخل العقار دون الحاجة لمغادرة منازلهم، مما يوفر تجربة تفاعلية وواقعية.</li>
                <li><strong>منظور الشارع:</strong> تمكن المستخدمين من استكشاف المناطق المحيطة بالعقار من خلال عرض يشبه التجول الفعلي في الشوارع المجاورة، مما يساعد على فهم البيئة الحقيقية للموقع.</li>
                <li><strong>المنظور الجوي:</strong> باستخدام تقنيات الطائرات بدون طيار، يتم تقديم رؤية شاملة للعقار من الجو، مما يمنح المستخدمين نظرة كاملة على العقار والمناطق المحيطة به.</li>
                <li><strong>المرافق المجاورة:</strong> تعرض المنصة معلومات مفصلة حول المرافق والخدمات القريبة من العقار مثل المدارس، المستشفيات، المتاجر، وغيرها من الخدمات الضرورية التي تساعد في اتخاذ قرار شراء أو تأجير العقار.</li>
            </ul>

            <h3>ميزات إضافية لمزودي الخدمات</h3>

            <p>بالإضافة إلى خدمات العقارات، توفر منصة <em>أبعاد العقارية</em> فرصة فريدة لمزودي الخدمات (مثل شركات التصميم الداخلي، الصيانة، أو النقل) للإعلان عن خدماتهم مباشرة على العروض العقارية المناسبة. يتم ذلك بطريقة احترافية تتيح لمزودي الخدمات توجيه عروضهم بشكل مباشر للمستخدمين الذين يبحثون عن عقار أو بحاجة إلى خدمات متعلقة بالعقار. هذه الميزة توفر فرصة ترويجية ممتازة وتسهم في تسهيل التواصل بين مزودي الخدمات والمستخدمين.</p>

            <h3>الفوائد للجميع</h3>

            <ul>
                <li><strong>الباحثين عن العقار:</strong> يمكنهم الاستفادة من جميع المعلومات المتاحة عن العقار وخدماته، مما يساعد في اتخاذ قرار مستنير ومدروس. بالإضافة إلى ذلك، يمكن للمستخدمين الوصول إلى مجموعة متنوعة من الخدمات المتعلقة بالعقار مثل الصيانة أو التصميم الداخلي.</li>
                <li><strong>مزودي الخدمات:</strong> يمكنهم الترويج لخدماتهم بشكل مباشر على العقارات المناسبة، مما يزيد من فرص الوصول إلى العملاء المحتملين ويعزز من تواجدهم في السوق العقارية.</li>
            </ul>

            <h3>التواصل المباشر مع المعلن أو صاحب العقار</h3>

            <p>إحدى الميزات الفريدة في منصة <em>أبعاد العقارية</em> هي إمكانية التواصل المباشر مع المعلن أو صاحب العقار من خلال المنصة نفسها. يمكن للمستخدمين إرسال استفساراتهم بشكل فوري والحصول على إجابات سريعة، مما يعزز من سهولة وسلاسة عملية البحث عن العقار والتواصل بشأن التفاصيل.</p>

        </body>
        </html>

        @else
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Who we are? - Abaad Real Estate</title>
        </head>
        <body>

            <h1>Who we are?</h1>

            <p>In the past, the real estate market in Saudi Arabia was primarily managed through traditional means, relying on personal relationships and local knowledge. Obtaining accurate information about properties available for sale or rent was often complex and required direct contact with the owner or reliance on unregulated local brokers. This method was often unorganized and lacked transparency, making the market unstable and less attractive to investors.</p>

            <p>During this period, properties were marketed through paper advertisements and direct signage on the property itself. Communication between parties was mainly conducted through face-to-face meetings, which prolonged the process of closing deals. Furthermore, transactions lacked adequate legal protection, as there were no clear mechanisms for resolving disputes or ensuring the rights of the involved parties.</p>

            <h2>Development of the Real Estate Market through the General Real Estate Authority</h2>

            <p>With the establishment of the <em>General Real Estate Authority</em>, the Saudi real estate market witnessed a significant transformation toward professionalism and regulation. By establishing specific legislation and regulations, the Authority worked on developing a more transparent and stable real estate environment, helping to reduce manipulation and disputes within the market. The Authority also began issuing licenses to real estate brokers according to set standards and developing training programs to ensure that real estate services are provided professionally and in line with global best practices.</p>

            <p>The Authority also improved market transparency by providing accurate and up-to-date data on the real estate market, including prices, supply, and demand. This helped build greater trust between buyers and sellers. These steps contributed to attracting more local and international investments into the Saudi market, supporting sustainable real estate growth in alignment with Saudi Vision 2030.</p>

            <h2>An Expanded Overview of Abaad Real Estate Platform</h2>

            <p>The <em>Abaad Real Estate</em> platform represents a qualitative leap in how real estate is displayed and marketed in the Kingdom. The platform provides a comprehensive solution that meets the needs of all users, whether they are looking to buy property, rent, or even invest. By utilizing advanced technology, the platform offers a comprehensive experience that enables users to explore and evaluate properties without the need for physical visits, saving time and effort.</p>

            <h3>Key Features of Abaad Real Estate Platform</h3>

            <ul>
                <li><strong>High-Resolution Images:</strong> The platform provides high-quality images for all listed properties, allowing users to view detailed aspects of the property clearly.</li>
                <li><strong>Detailed Floor Plans:</strong> The site offers comprehensive architectural plans for the properties, helping users visualize the interior layout and space distribution accurately.</li>
                <li><strong>Informative Videos:</strong> Each property can feature videos showcasing both interior and exterior details, providing users with a realistic and dynamic perspective.</li>
                <li><strong>360-Degree Virtual Tours:</strong> Users can take virtual tours of the property without leaving their homes, providing an interactive and immersive experience.</li>
                <li><strong>Street View:</strong> This feature allows users to explore the surrounding areas of the property through a view similar to actual street exploration, helping them understand the real environment of the location.</li>
                <li><strong>Sky View:</strong> Using drone technology, a complete aerial view of the property is provided, giving users a comprehensive look at the property and its surrounding areas.</li>
                <li><strong>Nearby Facilities:</strong> The platform provides detailed information about nearby facilities and services such as schools, hospitals, shops, and other essential services that assist in making a purchasing or renting decision.</li>
            </ul>

            <h3>Additional Features for Service Providers</h3>

            <p>In addition to real estate services, the <em>Abaad Real Estate</em> platform offers a unique opportunity for service providers (such as interior design companies, maintenance, or moving services) to advertise their services directly on the relevant property listings. This is done in a professional manner that allows service providers to target their offerings directly to users searching for properties or needing property-related services. This feature provides an excellent promotional opportunity and facilitates communication between service providers and users.</p>

            <h3>Benefits for Everyone</h3>

            <ul>
                <li><strong>Property Seekers:</strong> They can benefit from all the available information about the property and its services, helping them make informed and well-considered decisions. Additionally, users can access a variety of property-related services such as maintenance or interior design.</li>
                <li><strong>Service Providers:</strong> They can promote their services directly on the appropriate property listings, increasing their chances of reaching potential customers and enhancing their presence in the real estate market.</li>
            </ul>

            <h3>Direct Communication with Advertisers or Property Owners</h3>

            <p>One of the unique features of the <em>Abaad Real Estate</em> platform is the ability to communicate directly with the advertiser or property owner through the platform itself. Users can send inquiries instantly and receive prompt responses, making the property search and communication process more efficient and seamless.</p>

        </body>
        </html>

        @endif
    </div>
@endsection
