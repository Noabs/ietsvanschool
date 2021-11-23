package gametest11;

import javafx.application.Application;
import static javafx.application.Application.launch;
import javafx.scene.Group;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.stage.Stage;
import javax.swing.JOptionPane;
/**
 * "Aan de slag met Java en JavaFX" opstartklasse
 * @author noahh
 */
public class GameTest11 extends Application 
{
    private Group root;
            
    @Override
    public void start(Stage primaryStage) 
    {
        
        primaryStage.setTitle( "Test" );
        
        root = new Group();
        Scene theScene = new Scene( root, 1000, 1000);
        primaryStage.setScene( theScene );
        
        Button btnStart = new Button("Start");
        Button btnOpties = new Button("Opties");
        
        
        btnStart.setOnAction(event->{
        Game game = new Game(root);
        });
        
        btnOpties.setOnAction(event->{
            JOptionPane.showMessageDialog(null, "Controls:                      "
                    + "Gebruik W A S D om te bewegen                      "
                    + "De pijltje toetsen om verschillende kanten op te schieten                      "
                    + "Klik op de Escape toets om het spel af te sluiten                      "
                    + "Klik op de Spatie toets om een nieuw potje te starten                      ");
        });
        
        root.getChildren().addAll(btnStart, btnOpties);    
        btnStart.relocate(10, 10);     
        btnOpties.relocate(70, 10);
        primaryStage.show();
    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) 
    {
        launch(args);
    }

}
