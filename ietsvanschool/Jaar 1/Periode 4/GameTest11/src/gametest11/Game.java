package gametest11;

import java.io.File;
import java.io.FileInputStream;
import java.io.InputStream;
import javafx.animation.Timeline;
import javafx.scene.Group;
import javafx.scene.canvas.Canvas;
import javafx.scene.canvas.GraphicsContext;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.animation.AnimationTimer;
import javafx.event.EventHandler;
import javafx.scene.input.KeyEvent;
import java.util.ArrayList;
import java.util.Iterator;
import javax.swing.JOptionPane;
import sun.audio.AudioPlayer;
import sun.audio.AudioStream;

public class Game
{

    //variabelen
    private int[] worldSize = new int[2];
    private Timeline gameLoop;

    private int bulletCount = 0;

    int rand;
    
    int geluid = 0;

    AnimationTimer gameloop;

    private boolean isShooting = false;
    private boolean isShooting2 = false;
    private boolean isShooting3 = false;
    private boolean isShooting4 = false;

    Sprite meteor;
    Sprite enemy;

    //arraylists aanmaken
    ArrayList<Sprite> bulletList = new ArrayList<Sprite>();
    ArrayList<Sprite> meteorList = new ArrayList<Sprite>();
    ArrayList<Sprite> starList = new ArrayList<Sprite>();
    ArrayList<Sprite> enemyList = new ArrayList<Sprite>();
    ArrayList<Sprite> objecten = new ArrayList<>();
        ArrayList<String> input = new ArrayList<String>();

    public Game(Group grp)
    {
        gameLoop = new Timeline();
        gameLoop.setCycleCount(Timeline.INDEFINITE);
            
        //grootte wereld
        worldSize[0] = 1000;
        worldSize[1] = 1000;

        int max = 4;
        int min = 1;
        int range = max - min + 1;
        rand = 1;
        
        //canvas aanmaken
        Canvas canvas = new Canvas(worldSize[0], worldSize[1]);
        grp.getChildren().add(canvas);
        
        //graphicsContext aanmaken
        GraphicsContext gc = canvas.getGraphicsContext2D();

        //key events
        grp.setOnKeyPressed(
                new EventHandler<KeyEvent>()
        {
            public void handle(KeyEvent e)
            {
                String code = e.getCode().toString();
                if (!input.contains(code))
                {
                    input.add(code);
                }
            }
        });

        grp.setOnKeyReleased(
                new EventHandler<KeyEvent>()
        {
            public void handle(KeyEvent e)
            {
                String code = e.getCode().toString();
                input.remove(code);
            }
        });
        
        //tekst instellen
        Font theFont = Font.font("Helvetica", FontWeight.BOLD, 24);
        gc.setFont(theFont);
        gc.setFill(Color.GREEN);
        gc.setStroke(Color.BLACK);
        gc.setLineWidth(1);

        //objecten maken
        Sprite achtergrond = new Sprite();
        achtergrond.setImage("achtergrond.png");
        achtergrond.setPosition(0, 0);

        Sprite speler = new Sprite();
        speler.setImage("player_W.png");
        speler.setPosition(500, 10);
        objecten.add(speler);

        //objecten maken & op random plekken plaatsen
        for (int i = 0; i < 20; i++)
        {
            meteor = new Sprite();
            meteor.setImage("meteor.png");
            double px = 850 * Math.random() + 50;
            double py = 850 * Math.random() + 50;
            meteor.setPosition(px, py);
            meteorList.add(meteor);
        }
        for (int i = 0; i < 20; i++)
        {
            Sprite star = new Sprite();
            star.setImage("star.gif");
            double px = 850 * Math.random() + 50;
            double py = 850 * Math.random() + 50;
            star.setPosition(px, py);
            starList.add(star);
        }
        for (int i = 0; i < 1; i++)
        {
            enemy = new Sprite();
            enemy.setImage("enemy.png");
            double px = 850 * Math.random() + 50;
            double py = 850 * Math.random() + 50;
            enemy.setPosition(px, py);
            enemyList.add(enemy);
            objecten.add(enemy);
        }

        LongValue lastNanoTime = new LongValue(System.nanoTime());

        //score en hp waar je mee begint
        IntValue score = new IntValue(0);
        IntValue hp = new IntValue(50);
        IntValue bosshp = new IntValue(500);

        gameloop = new AnimationTimer()
        {
            public void handle(long currentNanoTime)
            {
                //methode aanroepen
                border();
                
                //rekent uit wanneer er voor het laatst is geupdate
                double elapsedTime = (currentNanoTime - lastNanoTime.value) / 1000000000.0;
                lastNanoTime.value = currentNanoTime;

                //speler kunnen besturen
                speler.setVelocity(0, 0);
                if (input.contains("A"))
                {
                    speler.setImage("player_A.png");
                    speler.addVelocity(-200, 0);
                }
                if (input.contains("D"))
                {
                    speler.setImage("player_D.png");
                    speler.addVelocity(200, 0);
                }
                if (input.contains("W"))
                {
                    speler.setImage("player_W.png");
                    speler.addVelocity(0, -200);
                }
                if (input.contains("S"))
                {
                    speler.setImage("player_S.png");
                    speler.addVelocity(0, 200);
                }
                //speler laten schieten
                if (input.contains("LEFT") && isShooting == false)
                {
                    Sprite bullet = new Sprite();
                    bullet.setImage("bullet.png");
                    bulletList.add(bullet);
                    bulletList.get(bulletCount).addVelocity(-500, 0);
                    bulletList.get(bulletCount).setPosition(speler.positionX, speler.positionY);
                    bulletCount++;
                    isShooting = true;
                }
                if (input.contains("RIGHT") && isShooting2 == false)
                {
                    Sprite bullet = new Sprite();
                    bullet.setImage("bullet.png");
                    bulletList.add(bullet);
                    bulletList.get(bulletCount).addVelocity(500, 0);
                    bulletList.get(bulletCount).setPosition(speler.positionX, speler.positionY);
                    bulletCount++;
                    isShooting2 = true;
                }
                if (input.contains("UP") && isShooting3 == false)
                {
                    Sprite bullet = new Sprite();
                    bullet.setImage("bullet.png");
                    bulletList.add(bullet);
                    bulletList.get(bulletCount).addVelocity(0, -500);
                    bulletList.get(bulletCount).setPosition(speler.positionX, speler.positionY);
                    bulletCount++;
                    isShooting3 = true;
                }
                if (input.contains("DOWN") && isShooting4 == false)
                {
                    Sprite bullet = new Sprite();
                    bullet.setImage("bullet.png");
                    bulletList.add(bullet);
                    bulletList.get(bulletCount).addVelocity(0, 500);
                    bulletList.get(bulletCount).setPosition(speler.positionX, speler.positionY);
                    bulletCount++;
                    isShooting4 = true;
                }
                if (!input.contains("LEFT") && isShooting == true)
                {
                    isShooting = false;
                }
                if (!input.contains("RIGHT") && isShooting2 == true)
                {
                    isShooting2 = false;
                }
                if (!input.contains("UP") && isShooting3 == true)
                {
                    isShooting3 = false;
                }
                if (!input.contains("DOWN") && isShooting4 == true)
                {
                    isShooting4 = false;
                }
                //spel afsluiten
                if (input.contains("ESCAPE"))
                {
                    System.exit(1);
                }
                

                //interacties tussen objecten
                speler.update(elapsedTime);

                bulletList.forEach(bullet ->
                {
                    bullet.update(elapsedTime);
                    Iterator<Sprite> meteorIter = meteorList.iterator();
                    while (meteorIter.hasNext())
                    {
                        Sprite meteor = meteorIter.next();
                        if (speler.intersects(meteor))
                        {
                            meteorIter.remove();
                            hp.value -= 25;
                            

                        }
                        if (bullet.intersects(meteor))
                        {
                            meteorIter.remove();
                            score.value += 5;
                        }
                    }
                    if (bullet.intersects(enemy))
                    {
                        bosshp.value -= 1;
                    }

                });
                Iterator<Sprite> starIter = starList.iterator();
                while (starIter.hasNext())
                {
                    Sprite star = starIter.next();
                    if (speler.intersects(star))
                    {
                        starIter.remove();
                        score.value += 10;
                        
                    }
                }
                Iterator<Sprite> enemyIter = enemyList.iterator();
                while (enemyIter.hasNext())
                {
                    Sprite enemy = enemyIter.next();
                    if (speler.intersects(enemy))
                    {
                        hp.value -= 1;
                    }
                }
                //als je wint komt er een geluidje
                if (bosshp.value <= 0 && geluid == 0)
                {
                    InputStream music;

                    try
                    {
                        music = new FileInputStream(new File("applause7.wav"));
                        AudioStream audio = new AudioStream(music);
                        if (geluid > 0)
                        {
                            AudioPlayer.player.stop(audio);

                        } else
                        {
                            AudioPlayer.player.start(audio);

                        }
                    } catch (Exception e)
                    {
                        JOptionPane.showMessageDialog(null, "Error");
                    }
                    geluid++;
                }
                
                //als je verliest kom er een geluidje
                    if (hp.value <= 0 && geluid == 0)
                    {
                        InputStream music;

                        try
                        {
                            music = new FileInputStream(new File("mario.wav"));
                            AudioStream audio = new AudioStream(music);
                            if (geluid > 0)
                            {
                                AudioPlayer.player.stop(audio);

                            } else
                            {
                                AudioPlayer.player.start(audio);

                            }
                        } catch (Exception e)
                        {
                            JOptionPane.showMessageDialog(null, "Error");
                        }
                        geluid++;
                    }

                //render
                gc.clearRect(0, 0, 1000, 1000);
                achtergrond.render(gc);
                speler.render(gc);

                bulletList.forEach(bullet ->
                {
                    bullet.render(gc);
                });

                for (Sprite meteor : meteorList)
                {
                    meteor.render(gc);
                }

                for (Sprite star : starList)
                {
                    star.render(gc);
                }

                for (Sprite enemy : enemyList)
                {
                    enemy.render(gc);
                }

                //scoreboard
                String pointsText = "Punten: " + (score.value);
                String bossfight = "Boss: " + (bosshp.value);

                gc.fillText(pointsText, 100, 36);
                gc.strokeText(pointsText, 100, 36);

                //hp
                String hpText = "HP: " + (hp.value);

                gc.fillText(hpText, 10, 36);
                gc.strokeText(hpText, 10, 36);
                
                
                //het monster random laten rond bewegen
                if (score.value >= 150)
                {
                    enemy.setImage("enemy2.png");
                    gc.fillText(bossfight, 240, 36);
                    gc.strokeText(bossfight, 240, 36);

                    if (rand == 1)
                    {
                        enemy.addVelocity(-60, 0);
                        rand = (int) (Math.random() * range) + min;
                    }
                    if (rand == 2)
                    {
                        enemy.addVelocity(60, 0);
                        rand = (int) (Math.random() * range) + min;
                    }
                    if (rand == 3)
                    {
                        enemy.addVelocity(0, -60);
                        rand = (int) (Math.random() * range) + min;
                    }
                    if (rand == 4)
                    {
                        enemy.addVelocity(0, 60);
                        rand = (int) (Math.random() * range) + min;
                    }

                    enemy.update(elapsedTime);
                }
                
                //bepalen wanneer je wint of verliest
                if (hp.value <= 0)
                {
                    gc.setFill(Color.BLACK);
                    gc.fillText("GAME OVER", 400, 350);
                    gc.fillText("Druk op spatie om opniew te beginnen", 350, 400);
                    gameloop.stop();
                }
                if (bosshp.value <= 0)
                {
                    gc.setFill(Color.BLACK);
                    gc.fillText("You win!", 400, 350);
                    gc.fillText("Druk op spatie om opniew te beginnen", 350, 400);
                    achtergrond.setPosition(0, 0);
                    gameloop.stop();
                }
                

            }
        };
        gameloop.start();

    }
    //zorgt ervoor dat de player en enemy niet uit beeld kunnen
    public void border()
    {
        objecten.forEach(object ->
        {
            if (object.positionX < -10)
            {
                object.positionX = -10;
            }
            if (object.positionY < -10)
            {
                object.positionY = -10;
            }
            if (object.positionX > worldSize[0] - 50)
            {
                object.positionX = worldSize[0] - 50;
            }
            if (object.positionY > worldSize[1] - 50)
            {
                object.positionY = worldSize[1] - 50;
            }
        });
    }
}
