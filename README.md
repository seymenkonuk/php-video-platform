# PHP Video Platform
> PHP ile geliştirilmiş YouTube benzeri video paylaşım platformu.

## Açıklama

Kullanıcıların video, kısa video ve müzik içerikleri yükleyebildiği; kanallar oluşturabildiği, içerikleri izleyebildiği ve diğer kullanıcılarla etkileşime girebildiği sunucu taraflı bir web uygulaması.

## Kullanılan Teknolojiler

- PHP
- MySQL
- Redis
- Docker
- HTML / CSS / JS
- [Özel PHP MVC Framework](https://github.com/seymenkonuk/framework)

## Çalıştırma

Docker container'larını oluşturmak ve uygulamayı arka planda çalıştırmak için:

```bash
docker compose up -d
```

Uygulama başlatıldıktan sonra aşağıdaki adres üzerinden erişilebilir:

```bash
http://localhost:8080
```

Container'ları durdurmak için:

```bash
docker compose down
```

## Projenin Gelişim Süreci

Projenin geliştirilmesine 2023 yılının sonlarında bir ders projesi olarak başlandı. İlk sürümünde herhangi bir framework, routing sistemi veya MVC mimarisi kullanılmıyordu. Uygulama, doğrudan çalışan PHP dosyalarından oluşuyordu.

Uygulama büyüdükçe daha düzenli URL yapıları oluşturmak ve istekleri merkezi bir noktadan yönetmek amacıyla `.htaccess` tabanlı yönlendirme kullanılmaya başlandı. Bu aşamada `/videos/123` gibi adresler arka planda `index.php?controller=Video&action=Index&id=123` yapısına yönlendiriliyordu.

Daha sonra routing işlemleri PHP tarafına taşındı ve gelen isteklerin controller ile action yapılarına yönlendirildiği merkezi bir sistem geliştirildi. Projenin kapsamı genişledikçe model, view ve controller katmanları ayrılarak projeye özel bir MVC mimarisi oluşturuldu.

Zaman içinde bu yapıya middleware, istek doğrulama ve farklı uygulama servisleri eklendi. Ancak altyapı bileşenlerinin uygulama koduyla giderek daha fazla iç içe geçmesi, yeni özelliklerin eklenmesini ve mevcut yapının sürdürülebilirliğini zorlaştırmaya başladı.

Proje belirli bir olgunluğa ulaştıktan sonra mevcut altyapıyı genişletmeye devam etmek yerine yeniden kullanılabilir ve bağımsız bir framework geliştirmeye karar verildi. Projede edinilen deneyimler ve karşılaşılan ihtiyaçlar doğrultusunda hafif, modüler bir PHP MVC framework oluşturuldu.

Geliştirilen framework, video paylaşım platformunun yeni altyapısı olarak kullanılmaya başlandı. Önceki sürümdeki özellikler bu yapıya aktarıldı ve uygulamanın mimarisi yeni framework'e uygun şekilde düzenlendi.

> 💡 **Not:** Repository'nin mevcut commit geçmişi, projenin ilk düz PHP sürümlerini ve önceki mimari dönüşümlerini içermemektedir. 

## Demo

https://github.com/user-attachments/assets/ae2956af-54f5-4860-a938-ebf8e0b53139

## Lisans

Bu proje [MIT Lisansı](https://github.com/seymenkonuk/php-video-platform/blob/main/LICENSE) ile lisanslanmıştır.
