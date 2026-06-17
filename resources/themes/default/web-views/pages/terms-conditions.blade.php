@extends('layouts.front-end.app')

@section('title', translate('terms_and_Condition'))




@section('content')
    <div class="container py-5 rtl text-align-direction">
        <h2 class="text-center mb-3 headerTitle">{{translate('terms_and_condition')}}</h2>
        <div class="card-body text-justify">
            @if(app()->getLocale() == 'ar')
            <!DOCTYPE html>
                <html lang="ar">

                <body>
                    <div class="container">
                        <h1>شروط وسياسات تطبيق أبعاد العقاري</h1>
                        <p>يتعين على المستخدم الإطلاع على الشروط والسياسات لتطبيق أبعاد العقاري المملوك لمؤسسة ابعاد الإحتراف للخدمات التسويقية (رقم السجل التجاري: 2050163713)، وتم الحصول على شهادة توثيق التجارة الإلكترونية (رقم الوثيقة: 0000095261)، بما يتوافق مع القوانين والأنظمة المعمول بها في المملكة العربية السعودية. ومن بين هذه الشروط والسياسات:</p>

                        <div class="section">
                            <h2>1. شروط الاستخدام والتسجيل</h2>
                            <p>يجب على المستخدمين قبول الشروط والأحكام قبل استخدام التطبيق، بما في ذلك سياسة الخصوصية والأمان.</p>
                        </div>

                        <div class="section">
                            <h2>2. سياسة الخصوصية</h2>
                            <p>توضح كيفية جمع واستخدام ومشاركة البيانات الشخصية للمستخدمين، وتضمن حقوقهم في الحفاظ على خصوصيتهم.</p>
                        </div>

                        <div class="section">
                            <h2>3. سياسة حقوق الملكية الفكرية</h2>
                            <p>تشهد الهيئة السعودية للملكية الفكرية بأن مؤسسة ابعاد الإحتراف لخدمات التسويق تم تسجيل مصنفاتها "برمجيات وتطبيقات الحاسب الآلي لمنصة ابعاد"، وتم تسجيله برقم التسجيل (24-12-8616668) بتاريخ (18/08/1445هـ) الموافق (28/02/2024م) وفقاً للنسخة المودعة لدى الهيئة السعودية للملكية الفكرية. وتحدد حقوق والتزامات المستخدمين فيما يتعلق بحقوق الملكية الفكرية للمحتوى المشارك على التطبيق:</p>
                            <ul>
                                <li><b>أ. حقوق الطبع والنشر:</b>
                                    <ul>
                                        <li>جميع المحتويات المتاحة على تطبيق "ابعاد العقاري"، بما في ذلك النصوص، الصور، الرسومات، والرموز، محمية بموجب قوانين حقوق الطبع والنشر. تعتبر هذه المحتويات ملكاً لـ "ابعاد العقاري" أو لمزودي المحتوى المعنيين، إلا إذا ذكر خلاف ذلك بوضوح.</li>
                                        <li>يُمنع نسخ أو توزيع أو نقل أو تعديل أو إعادة نشر أي جزء من المحتوى المتاح على التطبيق دون الحصول على إذن مسبق من صاحب حقوق الطبع والنشر.</li>
                                    </ul>
                                </li>
                                <li><b>ب. العلامات التجارية:</b>
                                    <ul>
                                        <li>جميع العلامات التجارية والشعارات المعروضة على التطبيق هي ملك لـ "ابعاد العقاري" أو لأطراف ثالثة. لا يُسمح باستخدام أو استنساخ أو توزيع هذه العلامات التجارية دون إذن صريح مسبق من الجهة المالكة.</li>
                                    </ul>
                                </li>
                                <li><b>ج. حقوق الملكية الفكرية للمستخدمين:</b>
                                    <ul>
                                        <li>بمجرد نشر المستخدم محتوى على التطبيق، يمنح "ابعاد العقاري" حق استخدام غير حصري ودائم لهذا المحتوى، بما في ذلك الحق في تعديل ونسخ ونشر وتوزيع وإظهار هذا المحتوى، وذلك بشرط عدم مخالفته لشروط الاستخدام.</li>
                                    </ul>
                                </li>
                                <li><b>د. بلاغات انتهاك حقوق الملكية الفكرية:</b>
                                    <ul>
                                        <li>نحن نلتزم بمعالجة بلاغات انتهاك حقوق الملكية الفكرية بمهنية وفعالية. يُرجى تقديم أي بلاغات عن انتهاكات محتملة لحقوق الملكية الفكرية عبر الوسائل المتاحة في التطبيق، وسنعمل على مراجعة ومعالجة هذه البلاغات بأسرع وقت ممكن.</li>
                                    </ul>
                                </li>
                                <li><b>ه. حقوق الملكية الفكرية لطرف ثالث:</b>
                                    <ul>
                                        <li>نحن نحترم حقوق الملكية الفكرية للآخرين، ونتعهد بعدم انتهاك حقوقهم المعنية. إذا كنت تعتقد أن هناك انتهاكًا لحقوق الملكية الفكرية لطرف ثالث على التطبيق، يُرجى الاتصال بنا لاتخاذ الإجراءات اللازمة.</li>
                                    </ul>
                                </li>
                                <li><b>و. التعديلات على السياسة:</b>
                                    <ul>
                                        <li>نحتفظ بالحق في تعديل هذه السياسة في أي وقت ودون إشعار مسبق. يجب على المستخدمين مراجعة السياسة بانتظام للتأكد من أنهم على دراية بأحدث التحديثات.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="section">
                            <h2>4. المسؤوليات والالتزامات</h2>
                            <p>توضح المسؤوليات والالتزامات للمستخدمين والمطورين والمشرفين على التطبيق، بما في ذلك المسؤولية عن المحتوى المشارك وسلامته.</p>
                        </div>

                        <div class="section">
                            <h2>5. التوافق مع القوانين المحلية</h2>
                            <p>يجب أن يلتزم التطبيق بجميع القوانين والأنظمة المحلية المتعلقة بالعقارات والتجارة والملكية الفكرية في المملكة العربية السعودية. بما فيها الأنظمة واللوائح والأدلة للهيئة العامة للعقار (https://rega.gov.sa)، وأنظمة ولوائح وزارة التجارة (https://mc.gov.sa) وأنظمة ولوائح الهيئة السعودية للملكية الفكرية (https://www.saip.gov.sa).</p>
                        </div>

                        <div class="section">
                            <h2>6. الإخطارات القانونية</h2>
                            <p>في حالات الانتهاكات أو الاختلافات والنزاعات يجب أن يتم الرجوع والتحكيم إلى القضاء والأنظمة والقوانين المعمول بها في المملكة العربية السعودية.</p>
                        </div>

                        <div class="section">
                            <h2>7. التحديثات والتعديلات</h2>
                            <p>يمكن ويحق لتطبيق ابعاد العقاري من إجراء التعديلات والتحديثات اللازمة بموافقة المستخدمين.</p>
                        </div>

                        <div class="section">
                            <h2>8. ملكية البيانات والمحتوى</h2>
                            <ul>
                                <li>يظل المحتوى الذي يتم نشره عبر تطبيق "أبعاد العقاري" ملكية حصرية للمستخدمين الذين يقومون بنشره.</li>
                                <li>يلتزم المستخدمون بالامتثال لجميع القوانين واللوائح ذات الصلة بحقوق الملكية الفكرية والملكية الفردية للبيانات في المملكة العربية السعودية.</li>
                                <li>يخلي "أبعاد العقاري" عن أي مسؤولية تتعلق بالمحتوى المنشور أو المُشارك عبر التطبيق، ويتحمل المستخدمون المسؤولية الكاملة عن أي محتوى يقومون بنشره أو مشاركته عبر التطبيق والتأكد من صحة البيانات على سبيل المثال (رقم المعلن ورقم الإعلان وجميع معلومات الإعلان من نصوص وصور وفيديوهات.. الخ).</li>
                            </ul>
                        </div>

                        <div class="section">
                            <h2>9. سياسة الدعم الفني والاستفسارات</h2>
                            <p>في حالة الاستفسارات والشكاوى يرجى التواصل مع فريق دعم العملاء على البريد الإلكتروني (info@pdm.com)، أو تقديمها عبر خدمة الشكاوى المتوفرة بالتطبيق أو التواصل مع الدعم الفني (0138337733)، أو التواصل عبر قنوات الدعم في حساباتنا بمنصات التواصل الاجتماعي.</p>
                        </div>

                        <div class="section">
                            <h2>10. المسؤولية المالية</h2>
                            <p>يخلي "ابعاد العقاري" مسؤوليته عن أي التزامات أو تحويلات أو مدفوعات مالية بين أي طرف مستخدم للمنصة.</p>
                        </div>

                        <div class="section">
                            <h2>11. سياسة الدفع والاشتراكات</h2>
                            <p>يتم التسجيل والاشتراك حسب المتطلبات والشروط والعروض التي تقدم بشكل دوري يتم الإعلان عنه بشكل رسمي.</p>
                        </div>

                        <div class="section">
                            <h2>12. سياسة استخدام البيانات الجغرافية</h2>
                            <p>يتم تحديد ونشر البيانات الجغرافية من قبل المستخدمين للتطبيق، ويتحمل المعلنين صحة ودقة ومسؤولية تلك البيانات.</p>
                        </div>

                        <div class="section">
                            <h2>13. سياسة الامتثال لمعايير الأمان والمعلوماتية</h2>
                            <p>يجب الالتزام وتطبيق معايير الأمان والمعلوماتية، وعدم التجاوز أو انتهاك شروط ومتطلبات الأمن السيبراني.</p>
                        </div>

                        <div class="section">
                            <h2>14. سياسة استخدام العلامات التجارية</h2>
                            <p>يُعد استخدام العلامات التجارية للتطبيق أو المشتركين بدون علم وإذن مسبق مخالفة يحاسب عليها حسب الأنظمة ولوائح وسياسات الحماية الفكرية.</p>
                        </div>

                        <div class="section">
                            <h2>15. سياسة الإعلانات والتسويق</h2>
                            <ul>
                                <li><b>أ. الإعلانات:</b> تحتفظ "أبعاد العقاري" بالحق في عرض الإعلانات داخل التطبيق بمختلف أنواعها، بما في ذلك الإعلانات النصية والصورية والفيديو. ويتم عرض الإعلانات بهدف تحسين تجربة المستخدم وتقديم المزيد من الفرص والخدمات ذات الصلة.</li>
                                <li><b>ب. الإعلانات المستهدفة:</b> قد تستخدم شركة "أبعاد العقاري" تقنيات التتبع والتحليل لتوجيه الإعلانات بناءً على سلوك المستخدم داخل التطبيق.</li>
                                <li><b>ج. التسويق:</b> يتم استخدام التسويق في التطبيق للتعريف بالخدمات والميزات الجديدة والعروض الخاصة للمستخدمين. ويتم توجيه الجهود التسويقية بما يتماشى مع اهتمامات واحتياجات المستخدمين.</li>
                                <li><b>د. الإعلانات المدفوعة:</b> قد تقدم "أبعاد العقاري" خدمات إعلانات مدفوعة للأطراف الثالثة الراغبة في الترويج لخدماتها داخل التطبيق.</li>
                                <li><b>ه. الإعفاء من المسؤولية:</b> لا تتحمل "أبعاد العقاري" أي مسؤولية عن محتوى الإعلانات التي تظهر داخل التطبيق أو عن أي خدمات تقدمها الأطراف الثالثة.</li>
                                <li><b>و. التحكم في الإعلانات:</b> يمكن للمستخدمين التحكم في تفضيلات الإعلانات وإدارتها عبر إعدادات التطبيق لضمان تجربة مستخدم مريحة.</li>
                                <li><b>ز. تعديلات وتحديثات:</b> تحتفظ "أبعاد العقاري" بالحق في تعديل أو تحديث سياسة الإعلانات والتسويق في أي وقت دون إشعار مسبق. ويجب على المستخدمين مراجعة السياسة بانتظام للبقاء على علم بأحدث التحديثات.</li>
                            </ul>
                        </div>

                        <div class="section">
                            <h2>16. سياسة المحتوى المخالف</h2>
                            <p>يحظر عرض الأنشطة أو المحتوى المحظور في التطبيق، مثل العنف، والتحريض على الكراهية، والإساءة، والترويج للمواد غير المشروعة.</p>
                        </div>
                    </div>
                </body>
                </html>

        @else



        <body>
            <div class="container">
                <h1>Terms and Policies of Abaad Real Estate Application</h1>
                <p>The user must review the terms and policies of the Abaad Real Estate application, which is owned by the Abaad Professional Marketing Services Corporation (Commercial Registration Number: 2050163713), and the e-commerce authentication certificate (document number: 0000095261) has been obtained, in accordance with the laws and regulations in force in the Kingdom of Saudi Arabia. Among these terms and policies are:</p>

                <div class="section">
                    <h2>1. Terms of use and registration:</h2>
                    <p>Users must accept the terms and conditions before using the application, including the privacy and security policy.</p>
                </div>

                <div class="section">
                    <h2>2. Privacy Policy:</h2>
                    <p>Explains how we collect, use and share users’ personal data, and guarantees their rights to maintain their privacy.</p>
                </div>

                <div class="section">
                    <h2>3. Intellectual Property Rights Policy:</h2>
                    <p>The Saudi Authority for Intellectual Property certifies that the Abaad Professional Marketing Services Foundation has registered its works, “Computer software and applications for the Abaad platform,” and it was registered under the registration number (24-12-8616668) on (08/18/1445 AH) corresponding to (02/28/2024 AD) according to the copy filed with the Saudi Authority for Intellectual Property. The rights and obligations of users regarding the intellectual property rights of the content shared on the application are determined:</p>
                    <ul>
                        <li><strong>a) Copyrights:</strong>
                            <ul>
                                <li>All content available on the “Abaad Real Estate” application, including texts, images, graphics, and symbols, is protected by copyright laws. These contents are considered the property of “Abaad Real Estate” or the relevant content providers, unless clearly stated otherwise.</li>
                                <li>It is prohibited to copy, distribute, transmit, modify or republish any part of the content available on the application without obtaining prior permission from the copyright holder.</li>
                            </ul>
                        </li>
                        <li><strong>b) Trademarks:</strong>
                            <ul>
                                <li>All trademarks and logos displayed on the application are the property of “Abaad Real Estate” or third parties. It is not permitted to use, reproduce or distribute these trademarks without prior express permission from the owner.</li>
                            </ul>
                        </li>
                        <li><strong>c) Intellectual property rights of users:</strong>
                            <ul>
                                <li>Once the user publishes content on the application, Abaad Real Estate is granted a non-exclusive and permanent right to use this content, including the right to modify, copy, publish, distribute and display this content, provided that it does not violate the terms of use.</li>
                            </ul>
                        </li>
                        <li><strong>d) Intellectual property infringement reports:</strong>
                            <ul>
                                <li>We are committed to handling reports of intellectual property rights violations professionally and effectively. Please submit any reports of possible violations of intellectual property rights through the means available in the application, and we will review and address these reports as quickly as possible.</li>
                            </ul>
                        </li>
                        <li><strong>e) Third party intellectual property rights:</strong>
                            <ul>
                                <li>We respect the intellectual property rights of others, and undertake not to infringe their respective rights. If you believe there is a violation of a third party's intellectual property rights on the Application, please contact us to take necessary action.</li>
                            </ul>
                        </li>
                        <li><strong>f) Amendments to the policy:</strong>
                            <ul>
                                <li>We reserve the right to modify this policy at any time and without prior notice. Users should review the Policy regularly to ensure they are aware of the latest updates.</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="section">
                    <h2>4. Responsibilities and Obligations:</h2>
                    <p>Clarifies the responsibilities and obligations of users, developers, and moderators of the application, including responsibility for the shared content and its safety.</p>
                </div>

                <div class="section">
                    <h2>5. Compliance with local laws:</h2>
                    <p>The application must comply with all local laws and regulations related to real estate, trade, and intellectual property in the Kingdom of Saudi Arabia. Including the rules, regulations and guides of the General Real Estate Authority (<a href="https://rega.gov.sa" target="_blank">https://rega.gov.sa</a>), the rules and regulations of the Ministry of Commerce (<a href="https://mc.gov.sa" target="_blank">https://mc.gov.sa</a>) and the rules and regulations of the Saudi Authority for Intellectual Property (<a href="https://www.saip.gov.sa" target="_blank">https://www.saip.gov.sa</a>).</p>
                </div>

                <div class="section">
                    <h2>6. Legal notices:</h2>
                    <p>In cases of violations, differences and disputes, arbitration must be referred to the judiciary, regulations and laws in force in the Kingdom of Saudi Arabia.</p>
                </div>

                <div class="section">
                    <h2>7. Updates and modifications:</h2>
                    <p>The Abaad Real Estate application can and has the right to make the necessary modifications and updates with the approval of the users.</p>
                </div>

                <div class="section">
                    <h2>8. Ownership of data and content:</h2>
                    <ul>
                        <li>The content published through the “Abaad Real Estate” application remains the exclusive property of the users who publish it.</li>
                        <li>Users are obligated to comply with all laws and regulations related to intellectual property rights and individual ownership of data in the Kingdom of Saudi Arabia.</li>
                        <li>“Abaad Real Estate” disclaims any responsibility related to the content published or shared through the application, and users bear full responsibility for any content they publish or share through the application and ensure the accuracy of the data, for example (advertiser number, advertisement number, and all advertising information such as texts, images, and videos. .etc.)</li>
                    </ul>
                </div>

                <div class="section">
                    <h2>9. Technical support and inquiries policy:</h2>
                    <p>In the case of inquiries and complaints, please contact the customer support team via email (<a href="mailto:info@pdm.com">info@pdm.com</a>), or submit them through the complaints service available in the application, or contact technical support (0138337733), or communicate through the support channels in our accounts on social media platforms.</p>
                </div>

                <div class="section">
                    <h2>10. Financial responsibility:</h2>
                    <p>“Abaad Real Estate” disclaims any responsibility for any obligations, transfers or financial payments between any party using the platform.</p>
                </div>

                <div class="section">
                    <h2>11. Payment and Subscriptions Policy:</h2>
                    <p>Registration and subscription are made according to the requirements, conditions and offers that are presented on a regular basis and are officially announced.</p>
                </div>

                <div class="section">
                    <h2>12. Geographic data use policy:</h2>
                    <p>Geographic data is determined and published by users of the application, and advertisers bear the validity, accuracy, and responsibility of that data.</p>
                </div>

                <div class="section">
                    <h2>13. Security and information standards compliance policy:</h2>
                    <p>Security and information standards must be adhered to and applied, and cybersecurity terms and requirements must not be exceeded or violated.</p>
                </div>

                <div class="section">
                    <h2>14. Trademark Use Policy:</h2>
                    <p>Using the trademarks of the application or subscribers without prior knowledge and permission is considered a violation for which he will be held accountable according to the laws, regulations and policies of intellectual protection.</p>
                </div>

                <div class="section">
                    <h2>15. Advertising and Marketing Policy:</h2>
                    <ul>
                        <li><strong>a) Advertisements:</strong>
                            <ul>
                                <li>Abaad Real Estate reserves the right to display advertisements within the application of various types, including text, image, and video advertisements. Ads are displayed with the aim of improving the user experience and providing more relevant opportunities and services.</li>
                            </ul>
                        </li>
                        <li><strong>b) Targeted Ads:</strong>
                            <ul>
                                <li>Abaad Real Estate may use tracking and analysis technologies to target ads based on user behavior within the application.</li>
                            </ul>
                        </li>
                        <li><strong>c) Marketing:</strong>
                            <ul>
                                <li>In-app marketing is used to introduce services, new features, and special offers to users. Marketing efforts are directed in line with the interests and needs of users.</li>
                            </ul>
                        </li>
                        <li><strong>d) Paid Ads:</strong>
                            <ul>
                                <li>“Abaad Real Estate” may provide paid advertising services to third parties wishing to promote their services within the application.</li>
                            </ul>
                        </li>
                        <li><strong>e) Exemption from liability:</strong>
                            <ul>
                                <li>Abaad Real Estate does not bear any responsibility for the content of advertisements that appear within the application or for any services provided by third parties.</li>
                            </ul>
                        </li>
                        <li><strong>f) Ad Control:</strong>
                            <ul>
                                <li>Users can control and manage advertising preferences via the app settings to ensure a comfortable user experience.</li>
                            </ul>
                        </li>
                        <li><strong>g) Amendments and updates:</strong>
                            <ul>
                                <li>Abaad Real Estate reserves the right to modify or update the advertising and marketing policy at any time without prior notice. Users should review the Policy regularly to stay informed of the latest updates.</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="section">
                    <h2>16. Violating Content Policy:</h2>
                    <p>Displaying prohibited activities or content in the application, such as violence, incitement to hatred, abuse, and promotion of illegal materials, is prohibited.</p>
                </div>
            </div>
        </body>

        @endif
    </div>
        </div>
    </div>
@endsection
