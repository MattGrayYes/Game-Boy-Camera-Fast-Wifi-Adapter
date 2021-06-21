# Game Boy Camera Fast Wifi Adapter
Plug in your Game Boy Camera, turn it on, and you can have the photos on your phone in under 2 minutes!

## Why I Made It & What I Used Before
I’ve had my Game Boy Camera since the ‘90s: it was my first digital camera, and I love it.

It can take and store 30 photos, but provides no way of taking the photos off it, other than deleting or printing with the Game Boy Printer. (That's '90s technology for you!)

Around 2013, I worked out a long-winded way to get photos off it onto my Mac using a 
[Mega Memory](https://amzn.to/3qkxBq7) and 
[GB EMS USB Smart Card](https://www.retromodding.com/products/gb-ems-usb-64m-smart-card).
This method was very fiddly and regularly took multiple attempts to work, and wasn't really portable.

I'd seen other portable devices before, but they all relied on emulating the Game Boy Printer and printing each photo one-by-one, which took even longer than fiddling with the Mega Memory!

In 2018 I found [InsideGadgets' GBxCart RW](https://www.gbxcart.com/), a USB Game Boy Cartridge Reader. This made the transfer so much easier, but it still wasn't portable because it requires a computer.

Months later, I had a brainwave: A [Raspberry Pi Zero](https://www.raspberrypi.org/products/raspberry-pi-zero-w/) is a computer! It's easily pocketable and battery powerable, and the GBxCart RW has linux support too! I got this kind of working, but it still required carrying around a jumble of cables.

The final piece of the puzzle came in December 2020 when [I got my first 3D Printer](https://www.youtube.com/watch?v=37BOSv3g0ls). I realised I could put this all together into one device, in one box, and this is what I ended up with!

## How it works

 1. Plug in Game Boy Camera.
 2. Turn it on.
 3. Wait a minute.
 4. Connect to the GameboyCamera wifi network.
 5. Go to http://gameboy.local
 6. All your photos will be visible on the webpage, and can be downloaded!
 7. Turn it off.

## Inside the 3D Printed Case
 - [Raspberry Pi Zero W](https://www.raspberrypi.org/products/raspberry-pi-zero-w/)
 - [InsideGadgets GBxCart RW v1.0a](https://www.gbxcart.com/)
 - [Adafruit Micro Lipo](https://www.adafruit.com/product/1904)
 - [LiPo Battery 500mAh](https://shop.pimoroni.com/products/lipo-battery-pack?variant=20429082055)
 - [USB Micro - USB Micro OTG cable](https://thepihut.com/products/micro-usb-to-micro-usb-otg-cable-10-12-25-30cm-long), shortened. (Possibly not this exact cable)
 - [Latching Torch Switch](https://www.ebay.co.uk/itm/184567179734?hash=item2af90fa9d6:g:x~IAAOSwrU1a~j8y)

## On The Pi
### Photo Downloader
 - /home/pi/get_photos.sh is set to run automatically on boot, by being included in /etc/rc.local
 - This script runs [GBxCart_RW_GBCamera_Saver_v1.8](https://github.com/insidegadgets/GBxCart-RW/tree/master/Interface_Programs)
 - And saves the photos inside /var/www/html/photos, so the web page can see them

### Web Page
 - Apache 2 web server with PHP 7
 - Files stored in /var/www/html/
 - index.php displays the photos in ./photos/, grouped by subfolder.

### Wifi Network
The Raspberry Pi hosts a wifi access point called GameboyCamera

 - Uses hostapd
 - Configured in /etc/hostapd/hostapd.conf
 - I'm not sure if just installing and creating that file is enough to make it work, I didn't make notes as I did it annoyingly.

### Issues
The Raspberry Pi doesn't keep time when it's turned off because it doesn't have a Real Time Clock, and I didn't want to wedge an external RTC into the box.

GBCamera_Saver is saving the photos into folders labelled with the date/time. It still seems to work, but this may cause a problem if it tries to create a folder with the same name again because "time is repeating itself"
