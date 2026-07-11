# PHP Video Platform
> PHP ile geliştirilmekte olan YouTube benzeri video paylaşım platformu.

## Açıklama

Kullanıcıların video, kısa video ve müzik içerikleri yükleyebildiği; kanallar oluşturabildiği, içerikleri izleyebildiği ve diğer kullanıcılarla etkileşime girebildiği sunucu taraflı bir web uygulaması.

Projenin önceki sürümünde temel işlevlerin önemli bir bölümü geliştirilmişti. Ancak proje büyüdükçe ortaya çıkan yeni ihtiyaçlar mevcut yapının geliştirilmesini ve bakımını zorlaştırdı. Bu nedenle eski kod tabanını genişletmeye devam etmek yerine proje, kendi geliştirdiğim hafif ve modüler PHP framework kullanılarak yeniden geliştirilmeye başlandı.

Önceki sürümde bulunan özellikler yeni mimari üzerinde aşamalı olarak yeniden uygulanmaktadır.

## Projenin Gelişim Süreci

Projenin ilk sürümünde herhangi bir framework, routing sistemi veya MVC mimarisi kullanılmıyordu. Uygulama, doğrudan çalışan PHP dosyalarından oluşuyordu.

Uygulama büyüdükçe daha düzenli URL yapıları oluşturmak ve istekleri merkezi bir noktadan yönetmek amacıyla `.htaccess` tabanlı yönlendirme kullanılmaya başlandı. Bu aşamada `/videos/123` gibi adresler arka planda `index.php?controller=Video&action=Index&id=123` yapısına yönlendiriliyordu.

Daha sonra routing işlemleri PHP tarafına taşındı ve gelen isteklerin controller ile action yapılarına yönlendirildiği merkezi bir sistem geliştirildi. Projenin kapsamı genişledikçe model, view ve controller katmanları ayrılarak projeye özel bir MVC mimarisi oluşturuldu.

Zaman içinde bu yapıya middleware, istek doğrulama ve farklı uygulama servisleri eklendi. Ancak altyapı bileşenlerinin uygulama koduyla giderek daha fazla iç içe geçmesi, yeni özelliklerin eklenmesini ve mevcut yapının sürdürülebilirliğini zorlaştırmaya başladı.

Proje belirli bir olgunluğa ulaştıktan sonra mevcut altyapıyı genişletmeye devam etmek yerine yeniden kullanılabilir ve bağımsız bir framework geliştirmeye karar verildi. Projede edinilen deneyimler ve karşılaşılan ihtiyaçlar doğrultusunda hafif, modüler bir PHP MVC framework oluşturuldu.

Video paylaşım platformu şu anda bu framework üzerinde yeniden geliştirilmektedir. Önceki sürümdeki işlevler yeni yapıya aktarılırken uygulama katmanları, bağımlılıklar ve ortak davranışlar daha düzenli ve sürdürülebilir bir mimariyle yeniden ele alınmaktadır.

> 💡 **Not:** Repository'nin mevcut commit geçmişi, projenin ilk düz PHP sürümlerini ve önceki mimari dönüşümlerini içermemektedir. 

## Kullanılan Teknolojiler

- PHP
- MySQL
- Redis
- Docker
- HTML / CSS / JS
- Özel PHP MVC Framework

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

## Demo

Projenin önceki mimariyle geliştirilen sürümüne ait demo:

https://github.com/user-attachments/assets/1591cf17-faef-4225-af75-b4bb0feb60e8

> 💡 **Not:** Demo, projenin mevcut framework ile yeniden geliştirilmeye başlanmasından önceki sürümünü göstermektedir.

## Lisans

Bu proje [MIT Lisansı](https://github.com/seymenkonuk/php-video-platform/blob/main/LICENSE) ile lisanslanmıştır.
